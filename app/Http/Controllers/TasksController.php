<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TasksController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/tasks",
     *     description="Get tasks",
     *
     *     tags={"Tasks"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                property="data",
     *                type="array",
     *                @OA\Items(
     *                   @OA\Property(
     *                       property="id",
     *                       type="integer",
     *                       nullable=false,
     *
     *                   ),
     *
     *                   @OA\Property(
     *                        property="title",
     *                        type="string",
     *                        nullable=false,
     *
     *                    ),
     *                   @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         nullable=true,
     *
     *                     ),
     *                   @OA\Property(
     *                         property="status",
     *                         type="string",
     *                         enum={"complete","waiting","incomplete","canceled"},
     *                         nullable=false,
     *
     *                     ),
     *                   @OA\Property(
     *                         property="priority",
     *                         type="string",
     *                         enum={"low", "medium", "high"},
     *                         nullable=false,
     *
     *                     ),
     *                   @OA\Property(
     *                         property="expiration",
     *                         type="string",
     *                         format="date",
     *                         nullable=false,
     *
     *                     ),
     *                   @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         format="date-time",
     *                         nullable=false,
     *                         example="2024-08-22T15:03:17.000000Z",
     *                     ),
     *                   @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         format="date-time",
     *                         nullable=false,
     *                         example="2024-08-22T15:03:17.000000Z",
     *                     ),
     *                )
     *             )
     *
     *
     *             )
     *         )
     *     )
     *)
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json([
            'status' => true,
            'message' => 'Tasks retrieved successfully',
            'data' => $tasks
        ], 200);
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Task found successfully',
            'data' => $task
        ], 200);
    }

    public function store(Request $request)
    {

             $data=  $request->validate([

            'title' => ['required', 'string'   ],
            'description'=> ['required', 'string'   ],
            'expiration'=> ['required', 'string'   ],
            'priority'=> ['required', 'string'   ],
            'status'=> ['required', 'string'   ],
         ]);
        $data['expiration']= \Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y/m/d', $data['expiration'])->format('Y-m-d'); //2016-05-8


//        if ($data->fails()) {
//            return response()->json([
//                'status' => false,
//                'message' => 'Validation error',
//                'errors' => $data->errors()
//            ], 422);
//        }



        $task = Task::create($data);

        ProcessTask::dispatch($task)->onQueue($task->priority->value);


        return response()->json([
            'status' => true,
            'message' => 'Task created successfully',
            'data' => $task

        ], 201);
    }

    public function update(Request $request, $id)
    {

        $data=  $request->validate([

            'title' => ['required', 'string'   ],
            'description'=> ['required', 'string'   ],
            'expiration'=> ['required', 'string'   ],
            'priority'=> ['required', 'string'   ],
            'status'=> ['required', 'string'   ],
        ]);
        $data['expiration']= \Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y/m/d', $data['expiration'])->format('Y-m-d'); //2016-05-8


//
//        if ($validator->fails()) {
//            return response()->json([
//                'status' => false,
//                'message' => 'Validation error',
//                'errors' => $validator->errors()
//            ], 422);
//        }

        $task = Task::findOrFail($id);
        $oldPriority = $task->priority->value;
        $task->update($data);
        if ($oldPriority !== $task->priority->value) {
            ProcessTask::dispatch($task)->onQueue($task->priority->value);
        }

        return response()->json([
            'status' => true,
            'message' => 'Task updated successfully',
            'data' => $task
        ], 200);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json([
            'status' => true,
            'message' => 'Task deleted successfully'
        ], 204);
    }
}


