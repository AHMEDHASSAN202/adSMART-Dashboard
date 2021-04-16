import React, {useEffect} from "react";
import {AppContext} from './../AppContext';
import {Reducer} from './../Reducer';
import {AppState} from './../AppState';
import Aside from './Aside';
import Wrapper from './Wrapper';
import { usePage } from '@inertiajs/inertia-react'
import Header from './Header';
import ProfileInfoPanel from './../Components/ProfileInfoPanel';
import NotificationPanel from './../Components/NotificationPanel';
import { InertiaProgress } from '@inertiajs/progress';
InertiaProgress.init({showSpinner: true})


export default function Layout ({children}) {
    const [data, dispatch] = React.useReducer(Reducer, {...AppState});
    const {activeId } = usePage().props;

    useEffect(() => {
        document.querySelector(`#menu-nav .menu-item.menu-item-active`)?.classList.remove('menu-item-active');
        let el = document.getElementById(activeId)?.closest('.menu-item').classList.add('menu-item-active');
        // let parents = getParents(el, 'menu-item');
        // parents.forEach((e) => {
        //     e.classList.add('menu-item-active');
        //     if (e.classList.contains('menu-item-submenu')) {
        //         e.classList.add('menu-item-open');
        //     }
        // })
    })

    //handle submenus
    // useEffect(() => {
    //     let parentsItems = document.querySelectorAll('#menu-nav .menu-item-submenu');
    //     parentsItems.forEach((i) => {
    //         i.addEventListener('click', (e) => {
    //             parentsItems.forEach((p) => {
    //                 if (p != i) {
    //                     if (p.classList.contains('menu-item-open')) {
    //                         p.classList.remove('menu-item-open');
    //                     }
    //                 }
    //             })
    //             i.classList.toggle('menu-item-open');
    //         })
    //     })
    // }, [])

    return (
        <AppContext.Provider value={{data, dispatch}}>
            <Aside />
            <div className="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

                <Header />

                <ProfileInfoPanel />

                <NotificationPanel />

                <Wrapper>
                    {children}
                </Wrapper>

                {/*<Footer />*/}
            </div>
        </AppContext.Provider>
    );
}
