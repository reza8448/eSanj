
<div class="card mb-7">
    <div class="card-header  border-0  pt-6">
        <div class="  card-title ">

            <div class="d-flex align-items-center position-relative my-1">

                <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6  ">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
														<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
													</svg>
												</span>

{{--                <input type="text" class="form-control form-control-solid ps-10 " name="search" value="" placeholder="جستجو"  wire:model.debounce.500ms="search"  />--}}
                                    <input type="text" class="form-control form-control-solid ps-10 " name="search" value="" placeholder="جستجو"  wire:model.debounce.500ms="search"  />
            </div>
            @if($search)

                <div class="btn btn-sm btn-icon "  name="close_search"   >
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <a href="#" onclick="location.reload()">
                        <span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
								</svg>
							</span>
                    </a>

                </div>

            @endif


        </div>
        <div class=" card-toolbar">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary  " id="add_task"> افزودن     </button>
  </div>
        </div>
    </div>


    <div class="card-body">


        <div class="card mb-5 mb-xl-8">

            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">لیست وظایف</span>

                </h3>

            </div>


            <div class="card-body py-3">

                <div class="table-responsive">


                    <table class="table align-middle gs-0 gy-4" wire:poll.10s>

                        <thead>
                        <tr class="fw-bolder text-muted bg-light">
                            <th class="ps-4 min-w-50px rounded-start">شناسه</th>
                            <th class="min-w-125px">عنوان</th>
                            <th class="min-w-125px">توضیحات</th>
                            <th class="min-w-200px">تاریخ انقضا</th>
                            <th class="min-w-100px">اولویت</th>
                            <th class="min-w-125px">وضعیت </th>
                            <th class="min-w-125px">تاریخ ایجاد</th>
                            <th class="min-w-125px">آخرین بروز رسانی</th>

                            <th class= " text-center    min-w-125px " >اقدامات</th>
                            {{--                        <th class="min-w-200px text-start rounded-end">اقدامات</th>--}}
                        </tr>
                        </thead>

                        <tbody>

                        @if(! $Tasks->count())
                            <tr>
                                <td colspan="10" style="text-align: center">
                                    <span>
                                                                            رکوردی برای نمایش وجودندارد

                                    </span>
                                </td>
                            </tr>


                        @endif
                        @foreach($Tasks as $Task)
                            <tr >


                                <th   class="p-5">{{$Task->id}}</th>
                                <td  class="p-5">{{$Task->title}}</td>
                                <td  class="p-5">{{$Task->description}}</td>
                                <td  class="p-5"> {{  jdate(  $Task->expiration) ->format(' %d/%B/%y'  ) }}  ساعت:  {{jdate(    $Task->expiration) ->format('H:i')}}  </td>
                                <td  class="p-5"> {{ $Task->priority->getLabelText()}}    </td>
                                <td  class="p-5">    {{  $Task->status->getLabelText()}}     </td>
                                <td  class="p-5">    {{  jdate(  $Task->created_at) ->format(' %d/%B/%y'  ) }}  ساعت:  {{jdate(    $Task->created_at) ->format('H:i')}}      </td>
                                <td  class="p-5">    {{  jdate(  $Task->updated_at) ->format(' %d/%B/%y'  ) }}  ساعت:  {{jdate(    $Task->updated_at) ->format('H:i')}}      </td>


                                <td class="d-flex">

                                    <a type="button"  class="  btn btn-sm btn-light-primary fw-bolder menu px-3 mt-1 menu mx-3"  name="edit_task"  task-id="{{$Task->id}}"   title="{{$Task->title}}" description="{{$Task->description }}"  expiration="{{ jdate(  $Task->created_at) ->format(' %Y/%m/%d'  )  }}" priority="{{$Task->priority}}" status="{{$Task->status }}">  <span > ویرایش  </span></a>

                                    <a href="#" class="  btn btn-sm btn-light-danger fw-bolder menu px-3 mt-1 menu px-3" name ="delete_task"   task-id="{{$Task->id}}" data-confirm-delete="true">حذف</a>

                                    </td>
                             </tr>
                        @endforeach


                        </tbody>

                    </table>

                </div>

            </div>

        </div>
        {{$Tasks->links()}}

    </div>


</div>

