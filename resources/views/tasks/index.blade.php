@component('layouts.content',['title'=>' لیست وظایف'])
    @slot('title')
        <title> لیست وظایف   </title>
    @endslot
    @slot('breadcrumb')

        <li class="breadcrumb-item active  " aria-current="page"> لیست وظایف   </li>

    @endslot
    <div class="content flex-row-fluid" id="kt_content">

        <div>
            <div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true"data-bs-backdrop="static" >
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">بروزرسانی</h5>


                        </div>

                        <div class="modal-footer " dir="ltr">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >بستن</button>

                        </div>
                    </div>
                </div>
            </div>

            <livewire:main-task />
        </div>

        <div class="modal fade" id="modal_task" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" >

            <div class="modal-dialog modal-dialog-centered mw-750px">

                <div class="modal-content">

                    <div class="modal-header">

                        <h2 class="fw-bolder" id="title"> </h2>

                        <div class="btn btn-icon btn-sm btn-active-icon-primary"data-bs-dismiss="modal">

                            <span class="svg-icon svg-icon-1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
														<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
													</svg>
												</span>

                        </div>

                    </div>

                    <div class="modal-body scroll-y mx-5 my-7">

                            <div class="d-flex     pe-10 row" id="modal_task_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modal_task_header" data-kt-scroll-wrappers="#modal_task_scroll" data-kt-scroll-offset="300px" style="max-height: 343px;">

                                <div class="fv-row mb-10 fv-plugins-icon-container col-md-6 ">

                                    <label class="fs-5 fw-bolder form-label mb-2">
                                        <span class="required">عنوان </span>
                                    </label>

                                    <input type="hidden"  id = "task_id" value="">
                                    <input class="form-control form-control-solid" placeholder="عنوان  خود را وارد نمایید" name="title"  edite ="name" value="">

                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                <div class="fv-row mb-10 fv-plugins-icon-container col-md-6 ">

                                    <label class="fs-5 fw-bolder form-label mb-2">
                                        <span class="required">تاریخ انقضا</span>
                                    </label>

                                    <input class="form-control form-control-solid"   name="expiration"  data-jdp>

                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                <div class="fv-row mb-10 fv-plugins-icon-container col-md-6 ">


                                    <label class="fs-5 fw-bolder form-label mb-2">
                                        <span class="required">اولویت</span>
                                    </label>
                            <select class="form-select mb-2  "  name="priority"  data-hide-search="true" data-placeholder="انتخاب "   tabindex="-1" aria-hidden="true">

                                        <option value ="choose"  selected="selected">انتخاب کنید</option>
                                        <option value="High">بالا </option>
                                        <option value="mid">متوسط</option>
                                        <option value="low"> پایین</option>

                                    </select>

                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                <div class="fv-row mb-10 fv-plugins-icon-container col-md-6 ">


                                    <label class="fs-5 fw-bolder form-label mb-2">
                                        <span class="required">وضعیت</span>
                                    </label>

                                     <select class="form-select mb-2  "name="status"   data-placeholder="انتخاب "   tabindex="-1" aria-hidden="true">


                                        <option value ="choose"   selected="selected">انتخاب کنید</option>
                                        <option value="complete">کامل شده </option>
                                        <option value="postponed">به تعویق افتاده</option>

                                        <option value="running">درحال انجام </option>
                                    </select>

                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                <div class="fv-row mb-10 fv-plugins-icon-container col-md-12 ">


                                    <label class="fs-5 fw-bolder form-label mb-2">
                                        <span class="required">توضیحات</span>
                                    </label>

                                    <input class="form-control form-control-solid"   placeholder="توضیحات مورد نظر را وارد کنید" name="description"   >


                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>

                            </div>

                            <div class="text-center pt-15">
                                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">انصراف</button>
                                <button  id="btn_modal"    data-kt-roles-modal-action="submit">
                                        <span class="indicator-label" name="modal-btn"> </span>
                                    <span class="indicator-progress">لطفا صبر کنید...
														<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>

                            </div>
                            <div>

                            </div>

                    </div>

                </div>

            </div>

        </div>



    </div>
    @slot('script')
        <script>
            jalaliDatepicker.show( $('[name=expiration]'));
            jalaliDatepicker.updateOptions(container, $('.modal-body')	);
        </script>


        <script src="/assets/js/CRUD-ajax.js"></script>

    @endslot
@endcomponent

