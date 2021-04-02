import react from 'react';

export default function NotificationPanel() {
    return (
        <div id="kt_quick_panel" className="offcanvas offcanvas-right pt-5 pb-10">

            <div className="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5">
                <ul className="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10"
                    role="tablist">
                    <li className="nav-item">
                        <a className="nav-link active" data-toggle="tab" href="#kt_quick_panel_notifications">Notifications</a>
                    </li>
                </ul>
                <div className="offcanvas-close mt-n1 pr-5">
                    <a href="#" className="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_panel_close">
                        <i className="ki ki-close icon-xs text-muted"></i>
                    </a>
                </div>
            </div>

            <div className="offcanvas-content px-10">
                <div className="tab-content">

                    <div className="tab-pane pt-2 pr-5 mr-n5 active" id="kt_quick_panel_notifications" role="tabpanel">

                        <div className="navi navi-icon-circle navi-spacer-x-0">

                            <a href="#" className="navi-item">
                                <div className="navi-link rounded">
                                    <div className="symbol symbol-50 mr-3">
                                        <div className="symbol-label"><i
                                            className="flaticon-bell text-success icon-lg"></i></div>
                                    </div>
                                    <div className="navi-text">
                                        <div className="font-weight-bold font-size-lg">
                                            5 new user generated report
                                        </div>
                                        <div className="text-muted">
                                            Reports based on sales
                                        </div>
                                    </div>
                                </div>
                            </a>


                            <a href="#" className="navi-item">
                                <div className="navi-link rounded">
                                    <div className="symbol symbol-50 mr-3">
                                        <div className="symbol-label"><i
                                            className="flaticon2-box text-danger icon-lg"></i></div>
                                    </div>
                                    <div className="navi-text">
                                        <div className="font-weight-bold  font-size-lg">
                                            2 new items submited
                                        </div>
                                        <div className="text-muted">
                                            by Grog John
                                        </div>
                                    </div>
                                </div>
                            </a>


                            <a href="#" className="navi-item">
                                <div className="navi-link rounded">
                                    <div className="symbol symbol-50 mr-3">
                                        <div className="symbol-label"><i
                                            className="flaticon-psd text-primary icon-lg"></i></div>
                                    </div>
                                    <div className="navi-text">
                                        <div className="font-weight-bold  font-size-lg">
                                            79 PSD files generated
                                        </div>
                                        <div className="text-muted">
                                            Reports based on sales
                                        </div>
                                    </div>
                                </div>
                            </a>


                            <a href="#" className="navi-item">
                                <div className="navi-link rounded">
                                    <div className="symbol symbol-50 mr-3">
                                        <div className="symbol-label"><i
                                            className="flaticon2-supermarket text-warning icon-lg"></i></div>
                                    </div>
                                    <div className="navi-text">
                                        <div className="font-weight-bold  font-size-lg">
                                            $2900 worth producucts sold
                                        </div>
                                        <div className="text-muted">
                                            Total 234 items
                                        </div>
                                    </div>
                                </div>
                            </a>


                            <a href="#" className="navi-item">
                                <div className="navi-link rounded">
                                    <div className="symbol symbol-50 mr-3">
                                        <div className="symbol-label"><i
                                            className="flaticon-paper-plane-1 text-success icon-lg"></i></div>
                                    </div>
                                    <div className="navi-text">
                                        <div className="font-weight-bold  font-size-lg">
                                            4.5h-avarage response time
                                        </div>
                                        <div className="text-muted">
                                            Fostest is Barry
                                        </div>
                                    </div>
                                </div>
                            </a>


                            <a href="#" className="navi-item">
                                <div className="navi-link rounded">
                                    <div className="symbol symbol-50 mr-3">
                                        <div className="symbol-label"><i
                                            className="flaticon-safe-shield-protection text-danger icon-lg"></i></div>
                                    </div>
                                    <div className="navi-text">
                                        <div className="font-weight-bold  font-size-lg">
                                            3 Defence alerts
                                        </div>
                                        <div className="text-muted">
                                            40% less alerts thar last week
                                        </div>
                                    </div>
                                </div>
                            </a>


                            <a href="#" className="navi-item">
                                <div className="navi-link rounded">
                                    <div className="symbol symbol-50 mr-3">
                                        <div className="symbol-label"><i
                                            className="flaticon-notepad text-primary icon-lg"></i></div>
                                    </div>
                                    <div className="navi-text">
                                        <div className="font-weight-bold  font-size-lg">
                                            Avarage 4 blog posts per author
                                        </div>
                                        <div className="text-muted">
                                            Most posted 12 time
                                        </div>
                                    </div>
                                </div>
                            </a>


                            <a href="#" className="navi-item">
                                <div className="navi-link rounded">
                                    <div className="symbol symbol-50 mr-3">
                                        <div className="symbol-label"><i
                                            className="flaticon-users-1 text-warning icon-lg"></i></div>
                                    </div>
                                    <div className="navi-text">
                                        <div className="font-weight-bold  font-size-lg">
                                            16 authors joined last week
                                        </div>
                                        <div className="text-muted">
                                            9 photodrapehrs, 7 designer
                                        </div>
                                    </div>
                                </div>
                            </a>


                            <a href="#" className="navi-item">
                                <div className="navi-link rounded">
                                    <div className="symbol symbol-50 mr-3">
                                        <div className="symbol-label"><i
                                            className="flaticon2-box text-info icon-lg"></i></div>
                                    </div>
                                    <div className="navi-text">
                                        <div className="font-weight-bold  font-size-lg">
                                            2 new items have been submited
                                        </div>
                                        <div className="text-muted">
                                            by Grog John
                                        </div>
                                    </div>
                                </div>
                            </a>


                            <a href="#" className="navi-item">
                                <div className="navi-link rounded">
                                    <div className="symbol symbol-50 mr-3">
                                        <div className="symbol-label"><i
                                            className="flaticon2-download text-success icon-lg"></i></div>
                                    </div>
                                    <div className="navi-text">
                                        <div className="font-weight-bold  font-size-lg">
                                            2.8 GB-total downloads size
                                        </div>
                                        <div className="text-muted">
                                            Mostly PSD end AL concepts
                                        </div>
                                    </div>
                                </div>
                            </a>


                            <a href="#" className="navi-item">
                                <div className="navi-link rounded">
                                    <div className="symbol symbol-50 mr-3">
                                        <div className="symbol-label"><i
                                            className="flaticon2-supermarket text-danger icon-lg"></i></div>
                                    </div>
                                    <div className="navi-text">
                                        <div className="font-weight-bold  font-size-lg">
                                            $2900 worth producucts sold
                                        </div>
                                        <div className="text-muted">
                                            Total 234 items
                                        </div>
                                    </div>
                                </div>
                            </a>


                            <a href="#" className="navi-item">
                                <div className="navi-link rounded">
                                    <div className="symbol symbol-50 mr-3">
                                        <div className="symbol-label"><i
                                            className="flaticon-bell text-primary icon-lg"></i></div>
                                    </div>
                                    <div className="navi-text">
                                        <div className="font-weight-bold  font-size-lg">
                                            7 new user generated report
                                        </div>
                                        <div className="text-muted">
                                            Reports based on sales
                                        </div>
                                    </div>
                                </div>
                            </a>


                            <a href="#" className="navi-item">
                                <div className="navi-link rounded">
                                    <div className="symbol symbol-50 mr-3">
                                        <div className="symbol-label"><i
                                            className="flaticon-paper-plane-1 text-success icon-lg"></i></div>
                                    </div>
                                    <div className="navi-text">
                                        <div className="font-weight-bold  font-size-lg">
                                            4.5h-avarage response time
                                        </div>
                                        <div className="text-muted">
                                            Fostest is Barry
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    );
}
