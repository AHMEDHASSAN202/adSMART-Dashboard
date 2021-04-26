import {useContext, useEffect, useState} from "react";
import Scroll from "./Scroll";
import {usePage} from '@inertiajs/inertia-react';
import {GET_USERS_AND_GROUPS_URL, LIMIT_USERS_GROUPS_LIST_ITEMS} from "../Constants";
import {ChatItem} from "../helpers";
import Loading from "./Loading";
import {AppContext} from "../AppContext";
import {setChat, setChatBoxLoading} from "../actions";

const ChatList = () => {
    const {auth} = usePage().props;
    const {dispatch} = useContext(AppContext);
    const [loading, setLoading] = useState(true);
    const [listItems, setListItems] = useState([]);
    const [originalItems, setOriginalItems] = useState([]);
    const [page, setPage] = useState();
    const [hiddenPaginate, setHiddenPaginate] = useState();

    useEffect(() => setPage(1), []);

    useEffect(() => {
        axiosInstanceWithoutCommonHeaders
            .get(GET_USERS_AND_GROUPS_URL + '?auth_token=' + auth.user_token + '&lang=' + currentLanguage.language_id + '&page=' + page)
            .then((r) => {
                const {data: {usersAndGroups=[]}} = r;
                if (usersAndGroups.length == 0) {
                    setHiddenPaginate(true);
                }
                let items = usersAndGroups.map((value) => {
                    return new ChatItem(value, auth);
                });
                setListItems([...listItems, ...items]);
                setOriginalItems([...originalItems, ...items]);
            })
            .catch((e) => {
                    setListItems([]);
            })
            .finally(() => setLoading(false));
    }, [page]);

    const handleItemClick = (e, item) => {
        e.preventDefault();
        dispatch(setChat(item));
        dispatch(setChatBoxLoading(true));
        axiosInstanceWithoutCommonHeaders
            .get(item.messagesUrl)
            .then((r) => {
                const {data:{messages}} = r;
                item.setMessages(messages, auth.user_id);
                dispatch(setChat(item));
            })
            .catch((e) => console.log(e))
            .finally(() => dispatch(setChatBoxLoading(false)));
    }

    const handleChangeSearch = (e) => {
        let items = originalItems.filter((item) => {
            return item.title.toLowerCase().includes((e.target.value).toLowerCase());
        })
        setListItems(items);
    }

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
                                        listItems.map((item, index) => (
                                            <div className="d-flex align-items-center justify-content-between mb-5" key={index}>
                                                <div className="d-flex align-items-center">
                                                    <div className="symbol symbol-circle symbol-50 mr-3 symbol-light-success">
                                                        {item.imageComponent}
                                                    </div>
                                                    <div className="d-flex flex-column">
                                                        <a
                                                            href='#'
                                                            className="text-dark-75 text-hover-primary font-weight-bold font-size-lg text-capitalize"
                                                            onClick={(e) => { handleItemClick(e, item) }}
                                                        >
                                                            {item.title}
                                                        </a>
                                                        <span className="text-muted font-weight-bold font-size-sm">
                                                    {item.subTitle}
                                                </span>
                                                        <span className="text-muted font-weight-bold font-size-sm">
                                                    {item.getLastMessage('message_content')}
                                                </span>
                                                    </div>
                                                </div>

                                                <div className="d-flex flex-column align-items-end">
                                                    <span className="text-muted font-weight-bold font-size-sm">{item.text}</span>
                                                </div>
                                            </div>
                                        ))
                                    }
                                    {
                                        (listItems.length > LIMIT_USERS_GROUPS_LIST_ITEMS && !hiddenPaginate) ? <a onClick={loadMoreItems} href='#' className='d-block text-center py-3'>load more!</a> : ''
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
