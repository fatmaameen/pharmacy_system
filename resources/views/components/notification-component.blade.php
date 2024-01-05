<div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
        id="page-header-notifications-dropdown" data-bs-toggle="dropdown"
        data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
        <i class='bx bx-bell fs-22'></i>
        <span
            class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{$count}}<span
                class="visually-hidden">unread messages</span></span>
    </button>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
        aria-labelledby="page-header-notifications-dropdown">

        <div class="dropdown-head bg-secondary bg-pattern rounded-top">
            <div class="p-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                    </div>
                    <div class="col-auto dropdown-tabs">
                        <span class="badge bg-light-subtle text-body fs-13"> {{$count}} New</span>
                    </div>
                </div>
            </div>

            <div class="px-2 pt-2">
                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true"
                    id="notificationItemsTab" role="tablist">
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab"
                            role="tab" aria-selected="true">
                            All ({{$count}})
                        </a>
                    </li>

                </ul>
            </div>

        </div>

        <div class="tab-content position-relative" id="notificationItemsTabContent">
            <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                <div data-simplebar style="max-height: 300px;" class="pe-2">
                    @foreach ($notification as $items)

                       <div class="text-reset notification-item d-block dropdown-item position-relative">
                        <div class="d-flex">
                            <div class="avatar-xs me-3 flex-shrink-0">
                                <span
                                    class="avatar-title bg-info-subtle text-info rounded-circle fs-16">
                                    <i class="bx bx-badge-check"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <a href="{{ route('show_addquantity' ,$items->id) }}" class="stretched-link">
                                    <h6 class="mt-0 mb-2 lh-base">{{$items->name}}


                                        <span class="text-secondary">(كمية:{{$items->total_stock}}) </span>
                                    </h6>
                                </a>

                            </div>
                            <div class="px-2 fs-15">

                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>

            </div>


            <div class="tab-pane fade p-4" id="alerts-tab" role="tabpanel"
                aria-labelledby="alerts-tab"></div>

            <div class="notification-actions" id="notification-actions">
                <div class="d-flex text-muted justify-content-center">
                    Select <div id="select-content" class="text-body fw-semibold px-1">0</div>
                    Result <button type="button" class="btn btn-link link-danger p-0 ms-3"
                        data-bs-toggle="modal"
                        data-bs-target="#removeNotificationModal">Remove</button>
                </div>
            </div>
        </div>
    </div>
</div>
