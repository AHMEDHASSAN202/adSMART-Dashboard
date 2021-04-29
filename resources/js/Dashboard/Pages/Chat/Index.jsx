import {useState} from 'react';
import Layout from "./../../Layout/Layout";
import Topbar from './../../Layout/Topbar';
import Content from "./../../Layout/Content";
import ChatList from "../../Components/ChatList";
import ChatBox from "../../Components/ChatBox";

const breadcrumb = [
    {
        title: translations['dashboard'],
        href: route('dashboard.index')
    }
];

const Index = (props) => {
    const [refreshList, setRefreshList] = useState();
    return (
        <>
            <Topbar title={props.pageTitle} breadcrumb={breadcrumb} />
            <Content>
                <div className="row">
                    <div className="col-md-7 col-sm-12" id='kt_chat_aside'>
                        <ChatList refreshList={refreshList} />
                    </div>
                    <div className="col-md-5 col-sm-12" id="kt_chat_content">
                        <ChatBox setRefreshList={setRefreshList} />
                    </div>
                </div>
            </Content>
        </>
    );
}


Index.layout = page => <Layout children={page}/>

export default Index;
