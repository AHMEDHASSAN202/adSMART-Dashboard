import {useContext, useEffect, useState} from "react";
import Scroll from "./Scroll";
import {usePage} from '@inertiajs/inertia-react';
import {ChatItem, Message} from "../helpers";
import Loading from "./Loading";
import {AppContext} from "../AppContext";
import {setChat, setChatBoxLoading} from "../actions";
import Service from "../Service";

const ChatList = ({refreshList}) => {
    const {auth: {user_token, user_id}} = usePage().props;
    const {data:{chatItem, onlineUsers}, dispatch} = useContext(AppContext);
    const [loading, setLoading] = useState(true);
    const [listItems, setListItems] = useState([]);
    const [originalItems, setOriginalItems] = useState([]);
    const [page, setPage] = useState();
    const [hiddenPaginate, setHiddenPaginate] = useState();

    //set current page for paginate
    useEffect(() => setPage(1), []);

    const getListOfUsersAndGroups = (refresh=false) => {
        Service.getListOfUsersAndGroups(user_token, page)
                .then((r) => {
                    const {data: {usersAndGroups=[]}} = r;
                    if (usersAndGroups.length == 0) {
                        setHiddenPaginate(true);
                    }
                    let items = usersAndGroups.map((value) => {
                        return new ChatItem(value, user_token, user_id);
                    });
                    if (refresh) {
                        setListItems(items);
                        setOriginalItems(items);
                    }else {
                        setListItems([...listItems, ...items]);
                        setOriginalItems([...originalItems, ...items]);
                    }
                })
                .finally(() => setLoading(false));
    }

    //when page change
    //we will send new users and groups request
    //store users and groups in same list and show same it
    useEffect(() => { getListOfUsersAndGroups() }, [page]);

    useEffect(() => { getListOfUsersAndGroups(true) }, [refreshList]);

    //handle click item
    //we will get messages for this item chat
    const handleItemClick = (e, item) => {
        e.preventDefault();
        dispatch(setChatBoxLoading(true));
        Service.getMessages(item.messagesUrl)
                .then((r) => {
                    const {data:{messages}} = r;
                    let msgs = [];
                    messages.forEach((msg) => {
                        msgs.push(new Message(msg, user_id));
                    });
                    dispatch(setChat({...item, chat: msgs}));
                })
                .finally(() => dispatch(setChatBoxLoading(false)));
    }

    //handle client search list items (users, groups)
    const handleChangeSearch = (e) => {
        let items = originalItems.filter((item) => {
            return item.title.toLowerCase().includes((e.target.value).toLowerCase());
        })
        setListItems(items);
    }

    //load more item
    //simple change page and useEffect hook sended request
    const loadMoreItems = (e) => {
        e.preventDefault();
        setPage((page + 1));
    }

    return (
        <div className="card card-custom">
            <div className="card-body">

                <div className="input-group input-group-solid">
                    <div className="input-group-prepend">
                        <span className="input-group-text">
                             <span className="svg-icon svg-icon-lg"></span>
                        </span>
                    </div>
                    <input
                        type="text"
                        className="form-control py-4 h-auto"
                        placeholder={translations['search']}
                        onChange={handleChangeSearch}
                    />
                </div>

                <Scroll height={400}>
                    <div className="mt-7 px-3">
                        {loading ? <Loading /> : ''}
                        {!listItems.length && !loading
                            ? <div>{translations['no_records_found']}</div>
                            : (
                                <>
                                    {
                                        listItems.map((item, index) => {
                                            if (chatItem?.randomId == item.randomId) {
                                                item = chatItem;
                                            }
                                            return (
                                                <div className={'d-flex align-items-center justify-content-between mb-5' + (item.randomId == chatItem?.randomId ? ' chat-item-active' : '')} key={index}>
                                                    <div className="d-flex align-items-center">
                                                        <div className="symbol symbol-circle symbol-50 mr-3 symbol-light-success">
                                                            {item.isUser && <span className={'label label-lg label-dot online-label ' + (onlineUsers.includes(item.id) ? 'is-online' : 'is-offline')}></span>}
                                                            {item.imageComponent}
                                                        </div>
                                                        <div className="d-flex flex-column">
                                                            <a
                                                                href='#'
                                                                className="text-dark-75 text-hover-primary font-weight-bold font-size-lg text-capitalize chat-title"
                                                                onClick={(e) => { handleItemClick(e, item) }}
                                                            >
                                                                {item.title}
                                                                <span className="text-muted font-weight-bold font-size-sm mx-2">
                                                                 {item.span}
                                                            </span>
                                                            </a>
                                                            <span className="text-muted font-weight-bold font-size-sm">
                                                            {item.subTitle}
                                                        </span>
                                                            <span className="text-muted font-weight-bold font-size-sm">
                                                                {item.chat.length == 0 ? '' : item.chat[(item.chat.length-1)].message_content}
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div className="d-flex flex-column align-items-end">
                                                        <span className="text-muted font-weight-bold font-size-sm">{item.text}</span>
                                                    </div>
                                                </div>
                                            )
                                        })
                                    }
                                    {
                                        (!hiddenPaginate && !loading) ? <a onClick={loadMoreItems} href='#' className='d-block text-center py-3'>load more!</a> : ''
                                    }
                                </>
                            )
                        }
                    </div>
                </Scroll>

            </div>
        </div>
    );
}


export default ChatList;
