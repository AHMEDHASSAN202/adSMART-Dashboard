import React, {useEffect} from "react";
import {AppContext} from './../AppContext';
import {Reducer} from './../Reducer';
import {AppState} from './../AppState';
import Aside from './Aside';
import Wrapper from './Wrapper';
import { Inertia } from '@inertiajs/inertia'
import { usePage } from '@inertiajs/inertia-react'
import {currentUrl} from './../actions';
import { InertiaProgress } from '@inertiajs/progress'
InertiaProgress.init({showSpinner: true})

export default function Layout ({children}) {
    const [data, dispatch] = React.useReducer(Reducer, AppState);
    const {props} = usePage()

    if (props.reload) {
        window.location.reload();
    }

    useEffect(() => {
        Inertia.on('navigate', (event) => {
            let url = window.location.protocol + "//" + window.location.host + event.detail.page.url;
            dispatch(currentUrl(url));
        })
    }, []);
    return (
        <AppContext.Provider value={{data, dispatch}}>
            <Aside />

            <Wrapper>
                {children}
            </Wrapper>
        </AppContext.Provider>
    );
}
