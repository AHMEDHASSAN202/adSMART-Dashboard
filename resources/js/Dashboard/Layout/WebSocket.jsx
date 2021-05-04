import {useEffect, useContext, useRef} from 'react';
import {SOCKET } from "../Constants";
import {AppContext} from "../AppContext";
import {setNewMessagesCount, setOnlineUsers} from "../actions";
import { usePage } from '@inertiajs/inertia-react'
import Hooks from "../../Common/Hooks";

const WebSocket = () => {
    const countMessagesRef = useRef(0)
    const {data:{chatItem}, dispatch} = useContext(AppContext);
    const {auth:{user_id}} = usePage().props;

    const newMessage = (msg) => {
        if (msg.fk_sender_id !== user_id) {
            if (!chatItem || (route('dashboard.chat.index') != window.location.href)) {
                countMessagesRef.current += 1;
                dispatch(setNewMessagesCount((countMessagesRef.current)));
            }
        }
    }

    const totalUnreadMessages = (total) => {
        countMessagesRef.current = +total;
        Hooks.do_action('total_unread_messages', countMessagesRef.current, dispatch)
    }

    useEffect(() => {

        SOCKET.on('onlineUsers', (data) => dispatch(setOnlineUsers(data)));

        SOCKET.on('total_unread_messages', totalUnreadMessages);

    }, [])

    useEffect(() => {

        SOCKET.on('private_message', newMessage);

        return () => SOCKET.off('private_message', newMessage);

    }, [chatItem])

    return ('');
}


export default WebSocket;
