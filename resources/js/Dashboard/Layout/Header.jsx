import react, {useContext, useEffect} from 'react';
import {toggleProfilePanel} from './../actions';
import {AppContext} from "../AppContext";
import LanguagesDropdown from "../Components/LanguagesDropdown";
import { InertiaLink, usePage } from '@inertiajs/inertia-react'

export default function Header() {
    const {data, dispatch} = useContext(AppContext);
    const {auth:{user_name}} = usePage().props;

    useEffect(() => {
        let btn = document.getElementById('kt_aside_toggle')
        let btnClose = document.getElementById('kt_aside_close')
        btn.addEventListener('click', () => {
                document.getElementById('kt_aside').classList.add('aside-on')
                document.getElementById('openSidebar').style.display = 'none';
                document.getElementById('closeSidebar').style.display = 'flex';
            })
        btnClose.addEventListener('click', () => {
            document.getElementById('kt_aside').classList.remove('aside-on')
            document.getElementById('openSidebar').style.display = 'flex';
            document.getElementById('closeSidebar').style.display = 'none';
        })
    }, []);

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

                    <div className="topbar-item" id='openSidebar' >
                        <button className="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                            <span className="svg-icon svg-icon svg-icon-xl svg-icon-info">
                               <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                        <path
                                            d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z"
                                            fill="#000000" fillRule="nonzero"/>
                                        <path
                                            d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z"
                                            fill="#000000" fillRule="nonzero" opacity="0.3"
                                            transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "/>
                                    </g>
                                </svg>
                            </span>
                        </button>
                    </div>

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
