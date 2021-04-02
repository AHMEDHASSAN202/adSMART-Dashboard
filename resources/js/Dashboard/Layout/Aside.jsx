import react, {useState, useEffect, useContext} from 'react';
import { InertiaLink } from '@inertiajs/inertia-react'
import AsideMenuLi from './../Components/AsideMenuLi';
import {AppContext} from "../AppContext";

export default function Aside () {
    const Pages = window.asideMenu;
    const {data} = useContext(AppContext);
    //handle active menu
    useEffect(() => {
        let currentActive = document.querySelector(`#menu-nav .menu-item.menu-item-active`);
        if (currentActive) {
            currentActive.classList.remove('menu-item-active')
        }
        let newActiveLink = document.querySelector(`#menu-nav .menu-link[href='${data.currentUrl}']`);
        if (newActiveLink) {
            newActiveLink.closest('.menu-item').classList.add('menu-item-active');
        }
    }, [data.currentUrl])

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
                    {/*<img alt="Logo" src="dashboard-assets/media/logos/logo-light.png"/>*/}
                    <h2 className='display-4 font-weight-boldest text-light'>InertiaJs</h2>
                </InertiaLink>
                <button className="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">+</button>
            </div>

            <div className="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                <div id="kt_aside_menu" className="aside-menu my-4 " data-menu-vertical="1" data-menu-scroll="1"
                     data-menu-dropdown-timeout="500">
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
