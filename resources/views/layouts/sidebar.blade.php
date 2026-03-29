<div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <!-- profile box -->
                <div class="profileBox pt-2 pb-2">
                    <div class="image-wrapper">
                        <img src="{{ asset('assets/img/logo-icon1.png') }}" alt="image" class="imaged  w36">
                    </div>
                    <div class="in">
                        <strong>{{ Str::ucfirst(Auth::user()->name) }}</strong>
                        <div class="text-muted">4029209</div>
                    </div>
                    <a href="#" class="btn btn-link btn-icon sidebar-close" data-bs-dismiss="modal">
                        <ion-icon name="close-outline"></ion-icon>
                    </a>
                </div>
                <!-- * profile box -->

                <!-- menu -->
                <div class="listview-title mt-1">Menu</div>
                <ul class="listview flush transparent no-line image-listview">
                    @can('departemen.view')
                        <li>
                            <a href="{{ route('departemen.index') }}" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="business-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Departemen
                                </div>
                            </a>
                        </li>
                    @endcan
                    @can('jabatan.view')
                        <li>
                            <a href="{{ route('jabatan.index') }}" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="git-network-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Jabatan
                                </div>
                            </a>
                        </li>
                    @endcan
                    @can('kantor.view')
                        <li>
                            <a href="{{ route('kantor.index') }}" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="home-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Kantor
                                </div>
                            </a>
                        </li>
                    @endcan
                    @can('listcuti.view')
                        <li>
                            <a href="{{ route('cuti.approval_cuti') }}" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="calendar-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Approval Cuti
                                </div>
                            </a>
                        </li>
                    @endcan
                    @can('listizin.view')
                        <li>
                            <a href="{{ route('izin.approval_izin') }}" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="calendar-number-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Approval Izin
                                </div>
                            </a>
                        </li>
                    @endcan
                    @can('jenisizin.view')
                        <li>
                            <a href="{{ route('jenis-izin.index') }}" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="folder-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Jenis Izin
                                </div>
                            </a>
                        </li>
                    @endcan
                    @can('user.view')
                        <li>
                            <a href="{{ route('users.index') }}" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="person-add-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    User
                                </div>
                            </a>
                        </li>
                    @endcan
                </ul>
                <!-- * menu -->

                <!-- Setting -->
                <div class="listview-title mt-1">Setting</div>
                <ul class="listview flush transparent no-line image-listview">
                    @can('role.view')
                        <li>
                            <a href="{{ route('role.index') }}" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="log-out-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Role
                                </div>
                            </a>
                        </li>
                    @endcan
                    @can('permission.view')
                        <li>
                            <a href="{{ route('permission.index') }}" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="log-out-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Permission
                                </div>
                            </a>
                        </li>
                    @endcan
                </ul>
                <!-- * Setting -->

                <!-- others -->
                <div class="listview-title mt-1">Others</div>
                <ul class="listview flush transparent no-line image-listview">
                    <li>
                        <a href="{{ route('logout') }}" class="item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <div class="icon-box bg-primary">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Log out
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- * others -->
            </div>
        </div>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
