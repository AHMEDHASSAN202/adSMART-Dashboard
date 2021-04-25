import {useEffect, useState} from "react";
import Scroll from "./Scroll";
import {usePage} from '@inertiajs/inertia-react';
import {GET_USERS_AND_GROUPS_URL} from "../Constants";
import {ChatItem} from "../helpers";

const ChatList = () => {
    const {auth} = usePage().props;
    const [listItems, setListItems] = useState([]);
    const [originalItems, setOriginalItems] = useState([]);

    useEffect(() => {
        axiosInstanceWithoutCommonHeaders
            .get(GET_USERS_AND_GROUPS_URL + '?auth_token=' + auth.user_token + '&lang=' + currentLanguage.language_id)
            .then((r) => {
                const {data: {usersAndGroups=[]}} = r;
                let items = usersAndGroups.map((value) => {
                    return new ChatItem(value);
                });
                setListItems(items);
                setOriginalItems(items);
            })
            .catch((e) => {
                    setListItems([]);
                    console.log(e);
                })
    }, []);

    const handleItemClick = (e, item) => {
        e.preventDefault();
        console.log(item);
    }

    const handleChangeSearch = (e) => {
        let items = originalItems.filter((item) => {
            return item.title.toLowerCase().includes((e.target.value).toLowerCase());
        })
        setListItems(items);
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
                        {!listItems.length
                            ? <div>{translations['no_records_found']}</div>
                            : (
                                listItems.map((item, index) => (
                                    <div className="d-flex align-items-center justify-content-between mb-5" key={index}>
                                        <div className="d-flex align-items-center">
                                            <div className="symbol symbol-circle symbol-50 mr-3 symbol-light-success">
                                                {item.imageComponent}
                                            </div>
                                            <div className="d-flex flex-column">
                                                <a
                                                    href='#'
                                                    className="text-dark-75 text-hover-primary font-weight-bold font-size-lg"
                                                    onClick={(e) => { handleItemClick(e, item) }}
                                                >
                                                    {item.title}
                                                </a>
                                                <span className="text-muted font-weight-bold font-size-sm">
                                            {item.subTitle}
                                        </span>
                                            </div>
                                        </div>

                                        <div className="d-flex flex-column align-items-end">
                                            <span className="text-muted font-weight-bold font-size-sm">{item.text}</span>
                                        </div>
                                    </div>
                                ))
                            )
                        }
                    </div>
                </Scroll>

            </div>
        </div>
    );
}


export default ChatList;
