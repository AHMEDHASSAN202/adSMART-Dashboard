import {useEffect, useContext} from 'react';
import {SOCKET } from "../Constants";
import {AppContext} from "../AppContext";
import {setOnlineUsers} from "../actions";
import { usePage } from '@inertiajs/inertia-react'
import {Message} from "../helpers";
import Hooks from "../../Common/Hooks";

const WebSocket = () => {
    const {data, dispatch} = useContext(AppContext);
    const {auth:{user_id}} = usePage().props;

    const newMessage = (msg) => {
        let message = new Message(msg, user_id);
        Hooks.do_action('new_message', message, data, dispatch)
    }

    useEffect(() => {

        SOCKET.on('onlineUsers', (data) => dispatch(setOnlineUsers(data)));

    }, [])

    useEffect(() => {

        SOCKET.on('private_message', newMessage);

        return () => SOCKET.off('private_message');

    }, [data.chatItem])

    return ('');
}


export default WebSocket;
