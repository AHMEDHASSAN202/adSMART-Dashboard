import Hooks from "../Common/Hooks";
import {setChat, setNewMessagesCount} from "./actions";
import {SOCKET} from "./Constants";

export default class Events {
    static run() {
        Hooks.add_action('new_message', Events.newMessage);
        Hooks.add_action('total_unread_messages', Events.totalUnreadMessages);
    }

    static newMessage(message, chatItem, listItems, setListItems, dispatch) {
        let listChatItems = listItems.map((item) => {
            if (Events.messageMatchCurrentChatItem(item, message)) {
                return {...item, chat: [...item.chat, message], text: message.created_at}
            }
            return item;
        })
        setListItems(listChatItems);
        if (chatItem) {
            if (Events.messageMatchCurrentChatItem(chatItem, message)) {
                if (!message.myMessage) {
                    let readDataMessage = {last_message_id: message.message_id}
                    if (message.group_id != null) {
                        readDataMessage.group_id = message.group_id;
                    }else {
                        readDataMessage.user_id = message.sender_id;
                    }
                    SOCKET.emit('unread_messages', readDataMessage);
                }
                dispatch(setChat({...chatItem, chat: [...chatItem.chat, message], text: message.created_at}));
            }else {
                SOCKET.emit('unread_messages', {});
            }
        }
    }

    static messageMatchCurrentChatItem(chatItem, message)
    {
        if (message.group_id != null) {
            return (message.group_id === chatItem.id && chatItem.isGroup);
        }

        return  ((chatItem.isUser && message.sender_id == chatItem.id)
                ||
                (chatItem.isUser && message.reciever_id == chatItem.id));
    }

    static totalUnreadMessages(total, dispatch)
    {
        dispatch(setNewMessagesCount(total));
    }
}
