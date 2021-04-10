import React, {useEffect} from "react";
import {AppContext} from './../AppContext';
import {Reducer} from './../Reducer';
import {AppState} from './../AppState';
import Aside from './Aside';
import Wrapper from './Wrapper';
import { Inertia } from '@inertiajs/inertia'
import {currentUrl} from './../actions';
import Header from './Header';
import ProfileInfoPanel from './../Components/ProfileInfoPanel';
import NotificationPanel from './../Components/NotificationPanel';
import { InertiaProgress } from '@inertiajs/progress';
InertiaProgress.init({showSpinner: true})


export default function Layout ({children}) {
    const [data, dispatch] = React.useReducer(Reducer, {...AppState});

    useEffect(() => {
        Inertia.on('navigate', (event) => {
            let url = window.location.protocol + "//" + window.location.host + event.detail.page.url;
            dispatch(currentUrl(url));
        })
    }, []);

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
