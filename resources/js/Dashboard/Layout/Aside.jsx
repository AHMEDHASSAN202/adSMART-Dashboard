import {useEffect} from 'react';
import { InertiaLink, usePage } from '@inertiajs/inertia-react'
import AsideMenuLi from './../Components/AsideMenuLi';

export default function Aside () {
    const Pages = window.asideMenu;
    const {options} = usePage().props;
    //handle submenus
    useEffect(() => {
        let parentsItems = document.querySelectorAll('#menu-nav .menu-item-submenu');
        parentsItems.forEach((i) => {
            i.addEventListener('click', (e) => {
                parentsItems.forEach((p) => {
                    if (p != i) {
                        if (p.classList.contains('menu-item-open')) {
                            p.classList.remove('menu-item-open');
                        }
                    }
                })
                i.classList.toggle('menu-item-open');
            })
        })
    }, [])

    return (
        <div className="aside aside-left  aside-fixed  d-flex flex-column flex-row-auto" id="kt_aside">

            <div className="brand flex-column-auto " id="kt_brand">
                <InertiaLink href='/dashboard'  className="brand-logo">
                    <h2 className='display-4 font-weight-boldest text-light'>{options['dashboard_title:' + window.currentLanguage.language_code]}</h2>
                </InertiaLink>
            </div>

            <div className="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                <div id="kt_aside_menu" className="aside-menu my-4 " data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
                    <ul className="menu-nav" id="menu-nav">

                        {Pages.map((page, i) => {
                            return (
                                <AsideMenuLi menu={page} key={i}/>
                            );
                        })}

                    </ul>
                </div>
            </div>
        </div>
    );
}
