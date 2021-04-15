import react, {useContext} from 'react';
import {toggleProfilePanel} from './../actions';
import {AppContext} from "../AppContext";
import LanguagesDropdown from "../Components/LanguagesDropdown";
import { InertiaLink, usePage } from '@inertiajs/inertia-react'

export default function Header() {
    const {data, dispatch} = useContext(AppContext);
    const {auth:{user_name}} = usePage().props;

    return (
        <div id="kt_header" className="header  header-fixed ">
            <div className=" container-fluid  d-flex align-items-stretch justify-content-between">

                <div className="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                    <div id="kt_header_menu" className="header-menu header-menu-mobile  header-menu-layout-default ">

                        <ul className="menu-nav ">
                            <li className="menu-item  menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-open menu-item-here menu-item-active"
                                data-menu-toggle="click" aria-haspopup="true">
                                <a href="/" className="menu-link menu-toggle">
                                    <span className="menu-text">{translations['website']}</span>
                                    <i className="menu-arrow"></i>
                                </a>
                            </li>
                            <li className="menu-item  menu-item-open menu-item-here menu-item-rel" aria-haspopup="true">
                                <InertiaLink href={route('dashboard.settings.index')} className="menu-link menu-toggle">
                                    <span className="menu-text">{translations['settings']}</span><
                                    i className="menu-arrow"></i>
                                </InertiaLink>
                            </li>
                        </ul>

                    </div>
                </div>


                <div className="topbar">
                    <div className="topbar-item">
                        <div className="btn btn-icon btn-clean btn-lg mr-1" id="kt_quick_panel_toggle">
		                <span className="svg-icon svg-icon-xl svg-icon-info">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink"
                                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"/>
                                    <path
                                        d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                        fill="#000000" opacity="0.3"/>
                                </g>
                            </svg>
                            </span></div>
                    </div>

                    <LanguagesDropdown languages={data.languages}/>

                    <div className="topbar-item">
                        <button
                            className="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
                            id="kt_quick_user_toggle"
                            onClick={() => dispatch(toggleProfilePanel(true))}
                        >
                            <span className="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">{translations['hi']},</span>
                            <span className="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3 text-capitalize">{user_name}</span>
                            <span className="symbol symbol-lg-35 symbol-25 symbol-light-success">
		                        <span className="symbol-label font-size-h5 font-weight-bold text-uppercase">{user_name[0]}</span>
		                    </span>
                        </button>
                    </div>

                </div>

            </div>
        </div>
    )
}
