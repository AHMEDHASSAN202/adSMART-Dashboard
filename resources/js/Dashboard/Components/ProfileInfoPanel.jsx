import react, {useContext} from 'react';
import {toggleProfilePanel} from './../actions';
import {AppContext} from "../AppContext";
import { InertiaLink } from '@inertiajs/inertia-react'
import PrimaryButton from "./PrimaryButton";
import { usePage } from '@inertiajs/inertia-react'

export default function ProfileInfoPanel() {
    const {props: {auth}} = usePage();
    const {data, dispatch} = useContext(AppContext);

    const myNavi = [
        {
            title: translations['profile_info'],
            desc: translations['account_desc'],
            icon: <i className="flaticon-profile-1 text-warning icon-lg"></i>,
            href: route('auth.dashboard.profile')
        },
        {
            title: translations['my_messages'],
            desc: translations['my_messages_desc'],
            icon: <i className="flaticon2-analytics text-danger icon-lg"></i>,
            href: route('dashboard.chat.index')
        },
        {
            title: translations['my_notification'],
            desc: translations['my_notification'],
            icon: <i className="flaticon2-world text-success icon-lg"></i>,
            href: '#'
        },
        {
            title: translations['settings'],
            desc: translations['settings_description'],
            icon: <i className="flaticon2-gear text-primary icon-lg"></i>,
            href: route('dashboard.settings.index')
        }
    ];

    return (

        <div id="kt_quick_user" className={"offcanvas offcanvas-right p-10 " + (data.openProfilePanel ? 'offcanvas-on' : '')}>

            <div className="offcanvas-header d-flex align-items-center justify-content-between pb-5">
                <h3 className="font-weight-bold m-0">
                    {translations['profile_info']}
                    <small className="text-muted font-size-sm ml-2">12 {translations['messages']}</small>
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
                        <div className="symbol-label" style={{backgroundImage: "url("+auth.user_avatar_full_path+")"}}></div>
                        <i className="symbol-badge bg-success"></i>
                    </div>
                    <div className="d-flex flex-column">
                        <InertiaLink href={route('auth.dashboard.profile')} className="font-weight-bold font-size-h5 text-dark-75 text-capitalize text-hover-primary">
                            {auth.user_name}
                        </InertiaLink>
                        <div className="text-muted mt-1 text-capitalize">
                            {auth.role.name}
                        </div>
                        <div className="navi mt-2">
                            <InertiaLink href={route('auth.dashboard.profile')} className="navi-item">
                                <span className="navi-link p-0 pb-2">
                                    <span className="navi-text text-muted text-hover-primary">{auth.user_email}</span>
                                </span>
                            </InertiaLink>
                            <form action={route('auth.dashboard.logout')} method='POST'>
                                <input type="text" name='_token' value={window.csrfToken} hidden readOnly />
                                <PrimaryButton type='submit'>
                                    <i className='flaticon-close icon-md m-icon'></i>
                                    {translations['signout']}
                                </PrimaryButton>
                            </form>
                        </div>
                    </div>
                </div>

                <div className="separator separator-dashed mt-8 mb-5"></div>

                <div className="navi navi-spacer-x-0 p-0">

                    {myNavi.map((n, key) => (
                        <InertiaLink href={n.href} key={key} className="navi-item">
                            <div className="navi-link">
                                <div className="symbol symbol-40 bg-light mr-3">
                                    <div className="symbol-label">
                                        {n.icon}
                                    </div>
                                </div>
                                <div className="navi-text">
                                    <div className="font-weight-bold">
                                        {n.title}
                                    </div>

                                    <div className="text-muted">
                                        {n.desc}
                                    </div>
                                </div>
                            </div>
                        </InertiaLink>
                    ))}

                </div>
            </div>

        </div>
    );
}
