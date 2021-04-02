import react, {useContext} from 'react';
import {toggleProfilePanel} from './../actions';
import {AppContext} from "../AppContext";

export default function ProfileInfoPanel() {

    const {data, dispatch} = useContext(AppContext);

    return (

        <div id="kt_quick_user" className={"offcanvas offcanvas-right p-10 " + (data.openProfilePanel ? 'offcanvas-on' : '')}>

            <div className="offcanvas-header d-flex align-items-center justify-content-between pb-5">
                <h3 className="font-weight-bold m-0">
                    User Profile
                    <small className="text-muted font-size-sm ml-2">12 messages</small>
                </h3>
                <button
                    className="btn btn-xs btn-icon btn-light btn-hover-primary"
                    id="kt_quick_user_close"
                    onClick={() => dispatch(toggleProfilePanel(false))}
                >
                    <i className="ki ki-close icon-xs text-muted"></i>
                </button>
            </div>



            <div className="offcanvas-content pr-5 mr-n5">

                <div className="d-flex align-items-center mt-5">
                    <div className="symbol symbol-100 mr-5">
                        <div className="symbol-label" style={{backgroundImage: "url('/dashboard-assets/media/users/300_21.jpg')"}}></div>
                        <i className="symbol-badge bg-success"></i>
                    </div>
                    <div className="d-flex flex-column">
                        <a href="#" className="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
                            James Jones
                        </a>
                        <div className="text-muted mt-1">
                            Application Developer
                        </div>
                        <div className="navi mt-2">
                            <a href="#" className="navi-item">
                        <span className="navi-link p-0 pb-2">
                            <span className="navi-icon mr-1"></span>
                            <span className="navi-text text-muted text-hover-primary">jm@softplus.com</span>
                        </span>
                            </a>

                            <a href="#" className="btn btn-sm btn-dark font-weight-bolder py-2 px-5">Sign Out</a>
                        </div>
                    </div>
                </div>



                <div className="separator separator-dashed mt-8 mb-5"></div>



                <div className="navi navi-spacer-x-0 p-0">

                    <a href="custom/apps/user/profile-1/personal-information.html" className="navi-item">
                        <div className="navi-link">
                            <div className="symbol symbol-40 bg-light mr-3">
                                <div className="symbol-label">
							<span className="svg-icon svg-icon-md svg-icon-success"></span>						</div>
                            </div>
                            <div className="navi-text">
                                <div className="font-weight-bold">
                                    My Profile
                                </div>
                                <div className="text-muted">
                                    Account settings and more
                                    <span className="label label-light-danger label-inline font-weight-bold">update</span>
                                </div>
                            </div>
                        </div>
                    </a>



                    <a href="custom/apps/user/profile-3.html"  className="navi-item">
                        <div className="navi-link">
                            <div className="symbol symbol-40 bg-light mr-3">
                                <div className="symbol-label">
 						   <span className="svg-icon svg-icon-md svg-icon-warning"></span> 					   </div>
                            </div>
                            <div className="navi-text">
                                <div className="font-weight-bold">
                                    My Messages
                                </div>
                                <div className="text-muted">
                                    Inbox and tasks
                                </div>
                            </div>
                        </div>
                    </a>



                    <a href="custom/apps/user/profile-2.html"  className="navi-item">
                        <div className="navi-link">
                            <div className="symbol symbol-40 bg-light mr-3">
                                <div className="symbol-label">
							<span className="svg-icon svg-icon-md svg-icon-danger"></span>						</div>
                            </div>
                            <div className="navi-text">
                                <div className="font-weight-bold">
                                    My Activities
                                </div>
                                <div className="text-muted">
                                    Logs and notifications
                                </div>
                            </div>
                        </div>
                    </a>



                    <a href="custom/apps/userprofile-1/overview.html" className="navi-item">
                        <div className="navi-link">
                            <div className="symbol symbol-40 bg-light mr-3">
                                <div className="symbol-label">
							<span className="svg-icon svg-icon-md svg-icon-primary"></span>						</div>
                            </div>
                            <div className="navi-text">
                                <div className="font-weight-bold">
                                    My Tasks
                                </div>
                                <div className="text-muted">
                                    latest tasks and projects
                                </div>
                            </div>
                        </div>
                    </a>

                </div>
            </div>

        </div>
    );
}
