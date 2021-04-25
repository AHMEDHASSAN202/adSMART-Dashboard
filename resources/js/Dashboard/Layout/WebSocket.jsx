import {useEffect, useContext} from 'react';
import {WebSocketServer, WebSocketServerOptions} from "../Constants";
import io from "socket.io-client";
import {AppContext} from "../AppContext";
import {setSocket} from "../actions";
import { usePage } from '@inertiajs/inertia-react'

const WebSocket = () => {
    const {dispatch} = useContext(AppContext);
    const {props} = usePage();

    useEffect(() => {

        const socket = io(WebSocketServer, {...WebSocketServerOptions, query: {auth_token: props.auth.user_token}});

        dispatch(setSocket(socket));

    }, [])

    return ('');
}


export default WebSocket;
