import {useEffect, useContext, useRef} from 'react';
import {AppContext} from "../AppContext";
import {setNewMessagesCount, setOnlineUsers} from "../actions";
import { usePage } from '@inertiajs/inertia-react'
import Hooks from "../../Common/Hooks";
import {SOCKET} from "../Constants";
import {compareTwoArray} from "../helpers";

const WebSocket = () => {
    const countMessagesRef = useRef(0)
    const {data:{chatItem, onlineUsers}, dispatch} = useContext(AppContext);
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

    const notification = (data) => Hooks.do_action('notification', data)

    const testEvent = (data) => Hooks.do_action('test_event', data)

    const handleOnlineUsers = (data) => {
        if (!compareTwoArray(data, onlineUsers)) {
            dispatch(setOnlineUsers(data));
        }
    }

    useEffect(() => {

        SOCKET.on('onlineUsers', handleOnlineUsers);
        SOCKET.on('total_unread_messages', totalUnreadMessages);
        SOCKET.on('notification', notification)
        SOCKET.on('test_event', testEvent)

        return () => {
            SOCKET.off('onlineUsers', handleOnlineUsers)
            SOCKET.off('total_unread_messages', totalUnreadMessages)
            SOCKET.off('notification', notification)
            SOCKET.off('test_event', testEvent)
        };
    }, [])

    useEffect(() => {
        SOCKET.on('private_message', newMessage);
        return () => SOCKET.off('private_message', newMessage);
    }, [chatItem])

    return ('');
}


export default WebSocket;
