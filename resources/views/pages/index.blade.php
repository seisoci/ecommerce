<x-app-layout :assets="$assets ?? []" :config="$config ?? []" isSelect2="true" isTour="true" isFlatpickr="true"  :isSidebar="true" :isBanner="false" :isPageContainer="true">
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 gap-3">
        <div class="d-flex flex-column">
            <h3>Quick Insights</h3>
            <p class="text-primary mb-0">Financial Dashboard</p>
        </div>
        <div class="d-flex justify-content-between align-items-center rounded flex-wrap gap-3">
            <div class="form-check form-switch mb-0 iq-status-switch">
                <input class="form-check-input iq-status" type="checkbox" id="iq-switch" checked="">
                <label class="form-check-label iq-reset-status" for="iq-switch">
                    Online
                </label>
            </div>
            <div class="form-group mb-0">
                <select class="select2-basic-single js-states form-control" name="state" style="width: 100%;">
                    <option >Past 30 Days</option>
                    <option >Past 60 Days</option>
                    <option >Past 90 Days</option>
                    <option >Past 1 year</option>
                    <option >Past 2 year</option>
                </select>
            </div>
            <div class="form-group mb-0">
                <input type="text" name="start" class="form-control range_flatpicker flatpickr-input active" placeholder="24 Jan 2022 to 23 Feb 2022" readonly="readonly">
            </div>
            <button type="button" class="btn btn-primary">Analytics</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card card-block card-stretch card-height">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-2">
                        <p class="mb-0 text-dark">Gross Volume</p>
                        <a class="badge rounded-pill bg-soft-primary" href="javascript:void(0);">
                            View
                        </a>
                    </div>
                    <div class="mb-3">
                        <h2 class="counter">$199,556</h2>
                        <small>Last updated 1 hour ago.</small>
                    </div>
                    <div>
                        <div id="grossVolume"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="row">
                <div class="col-12">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="mb-2 d-flex justify-content-between align-items-center">
                                <span class="text-dark ">USD Balance</span>
                                <a class="badge rounded-pill bg-soft-primary" href="javascript:void(0);">
                                    Request Payout
                                </a>
                            </div>
                            <h2 class="counter">$2590</h2>
                            <small>Available to pay out.</small>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="mb-2 d-flex justify-content-between align-items-center">
                                <span class="text-dark">No Of Payments</span>
                                <a class="badge rounded-pill bg-soft-primary" href="javascript:void(0);">
                                    View
                                </a>
                            </div>
                            <h2 class="counter">367</h2>
                            <small>Transactions this month</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-5 mb-md-0">
                            <div class="mb-5">
                                <div class="mb-2 d-flex justify-content-between align-items-center">
                                    <span class="text-dark">Last Transaction</span>
                                    <a class="badge rounded-pill bg-soft-primary" href="javascript:void(0);">
                                        View Report
                                    </a>
                                </div>
                                <div class="mb-2">
                                    <h2 class="counter">$58,556</h2>
                                    <small>This Month</small>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="bg-soft-primary avatar-60 rounded">
                                        <svg class="icon-35" width="35" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4" d="M17.554 7.29614C20.005 7.29614 22 9.35594 22 11.8876V16.9199C22 19.4453 20.01 21.5 17.564 21.5L6.448 21.5C3.996 21.5 2 19.4412 2 16.9096V11.8773C2 9.35181 3.991 7.29614 6.438 7.29614H7.378L17.554 7.29614Z" fill="currentColor"></path>
                                            <path d="M12.5464 16.0374L15.4554 13.0695C15.7554 12.7627 15.7554 12.2691 15.4534 11.9634C15.1514 11.6587 14.6644 11.6597 14.3644 11.9654L12.7714 13.5905L12.7714 3.2821C12.7714 2.85042 12.4264 2.5 12.0004 2.5C11.5754 2.5 11.2314 2.85042 11.2314 3.2821L11.2314 13.5905L9.63742 11.9654C9.33742 11.6597 8.85043 11.6587 8.54843 11.9634C8.39743 12.1168 8.32142 12.3168 8.32142 12.518C8.32142 12.717 8.39743 12.9171 8.54643 13.0695L11.4554 16.0374C11.6004 16.1847 11.7964 16.268 12.0004 16.268C12.2054 16.268 12.4014 16.1847 12.5464 16.0374Z" fill="currentColor"></path>
                                        </svg>
                                    </div>
                                    <div style="width: 100%;">
                                        <div class="d-flex justify-content-between  ">
                                            <h6>Received</h6>
                                            <h6 class="text-body">$5,674</h6>
                                        </div>
                                        <div class="progress bg-soft-primary shadow-none w-100" style="height: 6px">
                                            <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-soft-primary avatar-60 rounded">
                                        <svg class="icon-35" width="35" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M21.9964 8.37513H17.7618C15.7911 8.37859 14.1947 9.93514 14.1911 11.8566C14.1884 13.7823 15.7867 15.3458 17.7618 15.3484H22V15.6543C22 19.0136 19.9636 21 16.5173 21H7.48356C4.03644 21 2 19.0136 2 15.6543V8.33786C2 4.97862 4.03644 3 7.48356 3H16.5138C19.96 3 21.9964 4.97862 21.9964 8.33786V8.37513ZM6.73956 8.36733H12.3796H12.3831H12.3902C12.8124 8.36559 13.1538 8.03019 13.152 7.61765C13.1502 7.20598 12.8053 6.87318 12.3831 6.87491H6.73956C6.32 6.87664 5.97956 7.20858 5.97778 7.61852C5.976 8.03019 6.31733 8.36559 6.73956 8.36733Z" fill="currentColor"></path>
                                            <path opacity="0.4" d="M16.0374 12.2966C16.2465 13.2478 17.0805 13.917 18.0326 13.8996H21.2825C21.6787 13.8996 22 13.5715 22 13.166V10.6344C21.9991 10.2297 21.6787 9.90077 21.2825 9.8999H17.9561C16.8731 9.90338 15.9983 10.8024 16 11.9102C16 12.0398 16.0128 12.1695 16.0374 12.2966Z" fill="currentColor"></path>
                                            <circle cx="18" cy="11.8999" r="1" fill="currentColor"></circle>
                                        </svg>
                                    </div>
                                    <div style="width: 100%;">
                                        <div class="d-flex justify-content-between  ">
                                            <h6>Transferred</h6>
                                            <h6 class="text-body">$1,624</h6>
                                        </div>
                                        <div class="progress bg-soft-info shadow-none w-100" style="height: 6px">
                                            <div class="progress-bar bg-info" data-toggle="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="iq-scroller-effect">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-dark">Send Money To</span>
                                    <a href="#" class="badge rounded-pill bg-soft-primary">
                                        All Contacts
                                    </a>
                                </div>
                                <div class="d-flex align-items-center iq-slider mb-4 gap-2">
                                    <div>
                                        <img class="rounded-circle bg-soft-primary img-fluid avatar-40 mb-2" src="{{ asset('images/table/1.png') }}" alt="profile" loading="lazy" />
                                    </div>
                                    <div>
                                        <img class="rounded-circle bg-soft-primary img-fluid avatar-40 mb-2" src="{{ asset('images/table/2.png') }}" alt="profile" loading="lazy" />
                                    </div>
                                    <div>
                                        <img class="rounded-circle bg-soft-primary img-fluid avatar-40 mb-2" src="{{ asset('images/table/3.png') }}" alt="profile" loading="lazy" />
                                    </div>
                                    <div>
                                        <img class="rounded-circle bg-soft-primary img-fluid avatar-40 mb-2" src="{{ asset('images/table/4.png') }}" alt="profile" loading="lazy" />
                                    </div>
                                    <div>
                                        <img class="rounded-circle bg-soft-primary img-fluid avatar-40 mb-2" src="{{ asset('images/table/5.png') }}" alt="profile" loading="lazy" />
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group">
                                        <select class="select2-basic-single js-states form-control form-group" name="Account" style="width: 100%;">
                                            <option selected>Select Your Account</option>
                                            <option value="1">5521000120354</option>
                                            <option value="2">5521000125145</option>
                                            <option value="3">5521000129665</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="select2-basic-single-tag js-states form-control" name="Amount" style="width: 100%;">
                                            <option selected>Enter Amount in USD</option>
                                            <option value="1">100</option>
                                            <option value="2">200</option>
                                            <option value="5">500</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary w-100 mt-2">Send Money</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card card-block card-stretch card-height">
                <div class="card-header">
                        <div class=" d-flex justify-content-between  flex-wrap">
                        <h4 class="card-title">Net Volumes From Sales</h4>
                        <div class="dropdown">
                         <a href="#" class="text-secondary dropdown-toggle" id="dropdownMenuButton22" data-bs-toggle="dropdown" aria-expanded="false">
                         This year
                         </a>
                         <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton22">
                            <li><a class="dropdown-item" href="#">Year</a></li>
                            <li><a class="dropdown-item" href="#">Month</a></li>
                            <li><a class="dropdown-item" href="#">Week</a></li>
                         </ul>
                      </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="dashboard-line-chart" class="dashboard-line-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card card-block card-stretch card-height">
                <nav class="tab-bottom-bordered">
                    <div class="mb-0 nav nav-tabs justify-content-around" id="nav-tab1" role="tablist">
                        <button class="nav-link py-3 active" id="nav-home-11-tab" data-bs-toggle="tab" data-bs-target="#nav-home-11" type="button" role="tab" aria-controls="nav-home-11" aria-selected="true">Payments</button>
                        <button class="nav-link py-3" id="nav-profile-11-tab" data-bs-toggle="tab" data-bs-target="#nav-profile-11" type="button" role="tab" aria-controls="nav-profile-11" aria-selected="false">Settlements</button>
                        <button class="nav-link py-3" id="nav-contact-11-tab" data-bs-toggle="tab" data-bs-target="#nav-contact-11" type="button" role="tab" aria-controls="nav-contact-11" aria-selected="false">Refunds</button>
                    </div>
                </nav>
                <div class="tab-content iq-tab-fade-up" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home-11" role="tabpanel" aria-labelledby="nav-home-11-tab">
                        <div class="table-responsive">
                            <table id="transaction-table" class="table mb-0 table-striped" role="grid">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0">$1,833</h6>
                                            </div>
                                        </td>
                                        <td class="text-primary">
                                            hui_vxnnjigakm
                                        </td>
                                        <td class="text-dark">1 Hour Ago</td>
                                        <td class="text-end">
                                            <span class="badge rounded-pill bg-success ">Processed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0">$1,204</h6>
                                            </div>
                                        </td>
                                        <td class="text-primary">
                                            hui_uwsxaiuhhs
                                        </td>
                                        <td class="text-dark">23 Days Ago</td>
                                        <td class="text-end">
                                            <span class="badge rounded-pill bg-success">Processed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0">$2,833</h6>
                                            </div>
                                        </td>
                                        <td class="text-primary">
                                            hui_taxrcfzhny
                                        </td>
                                        <td class="text-dark">1 month ago</td>
                                        <td class="text-end">
                                            <span class="badge rounded-pill bg-success">Processed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0">$2,235</h6>
                                            </div>
                                        </td>
                                        <td class="text-primary">
                                            hui_pknfotsmhl
                                        </td>
                                        <td class="text-dark">1 month ago</td>
                                        <td class="text-end">
                                            <span class="badge rounded-pill bg-success">Processed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0">$2,442</h6>
                                            </div>
                                        </td>
                                        <td class="text-primary">
                                            hui_xqgczqbgto
                                        </td>
                                        <td class="text-dark">3 month ago</td>
                                        <td class="text-end">
                                            <span class="badge rounded-pill bg-success">Processed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0">$1,924</h6>
                                            </div>
                                        </td>
                                        <td class="text-primary">
                                            hui_eoasrkizdw
                                        </td>
                                        <td class="text-dark">4 month ago</td>
                                        <td class="text-end">
                                            <span class="badge rounded-pill bg-success">Processed</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile-11" role="tabpanel" aria-labelledby="nav-profile-11-tab">
                        <div class="table-responsive">
                            <table id="transaction-table-1" class="table mb-0 table-striped" role="grid">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0">$2,298</h6>
                                            </div>
                                        </td>
                                        <td class="text-primary">
                                            hui_ufsoishqbw
                                        </td>
                                        <td class="text-dark">7 Days Ago</td>
                                        <td class="text-end">
                                            <span class="badge rounded-pill bg-success ">Processed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0">$2,032</h6>
                                            </div>
                                        </td>
                                        <td class="text-primary">
                                            hui_fescijfgbb
                                        </td>
                                        <td class="text-dark">23 Days </td>
                                        <td class="text-end">
                                            <span class="badge rounded-pill bg-success">Processed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0">$1,514</h6>
                                            </div>
                                        </td>
                                        <td class="text-primary">
                                            hui_eihghndltk
                                        </td>
                                        <td class="text-dark">1 month ago</td>
                                        <td class="text-end">
                                            <span class="badge rounded-pill bg-success">Processed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0">$1,425</h6>
                                            </div>
                                        </td>
                                        <td class="text-primary">
                                            hui_bvihnfpdfq
                                        </td>
                                        <td class="text-dark">2 month ago</td>
                                        <td class="text-end">
                                            <span class="badge rounded-pill bg-success">Processed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0">$2,838</h6>
                                            </div>
                                        </td>
                                        <td class="text-primary">
                                            hui_afrtmvdyjp
                                        </td>
                                        <td class="text-dark">2 month ago</td>
                                        <td class="text-end">
                                            <span class="badge rounded-pill bg-success">Processed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0">$2,613</h6>
                                            </div>
                                        </td>
                                        <td class="text-primary">
                                            hui_jterqcvjxz
                                        </td>
                                        <td class="text-dark">5 month ago</td>
                                        <td class="text-end">
                                            <span class="badge rounded-pill bg-success">Processed</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-contact-11" role="tabpanel" aria-labelledby="nav-contact-11-tab">
                        <div class="table-responsive">
                            <table id="transaction-table-2" class="table mb-0 table-striped" role="grid">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0">$2,866</h6>
                                            </div>
                                        </td>
                                        <td class="text-primary">
                                            hui_odqethdqye
                                        </td>
                                        <td class="text-dark">3 Days Ago</td>
                                        <td class="text-end">
                                            <span class="badge rounded-pill bg-info ">Process</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0">$1,637</h6>
                                            </div>
                                        </td>
                                        <td class="text-primary">
                                            hui_nmngvsosnh
                                        </td>
                                        <td class="text-dark">22 Days Ago</td>
                                        <td class="text-end">
                                            <span class="badge rounded-pill bg-success">Refunded</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0">$2,922</h6>
                                            </div>
                                        </td>
                                        <td class="text-primary">
                                            hui_uikgtphcpo
                                        </td>
                                        <td class="text-dark">1 month ago</td>
                                        <td class="text-end">
                                            <span class="badge rounded-pill bg-success">Refunded</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0">$2,563</h6>
                                            </div>
                                        </td>
                                        <td class="text-primary">
                                            hui_cieqrdyqkp
                                        </td>
                                        <td class="text-dark">2 month ago</td>
                                        <td class="text-end">
                                            <span class="badge rounded-pill bg-info">Process</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0">$2,334</h6>
                                            </div>
                                        </td>
                                        <td class="text-primary">
                                            hui_wmdvzpfavx
                                        </td>
                                        <td class="text-dark">3 month ago</td>
                                        <td class="text-end">
                                            <span class="badge rounded-pill bg-success">Refunded</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0">$2,632</h6>
                                            </div>
                                        </td>
                                        <td class="text-primary">
                                            hui_jplpprjzbr
                                        </td>
                                        <td class="text-dark">5 month ago</td>
                                        <td class="text-end">
                                            <span class="badge rounded-pill bg-danger">Failed</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="javascript:void(0);">
                        <span class="me-2">
                            View all Settlements
                        </span>
                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
