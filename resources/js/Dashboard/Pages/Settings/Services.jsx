import {useContext} from 'react';
import Layout from "./../../Layout/Layout";
import Content from "./../../Layout/Content";
import CardComponent from "../../Components/CardComponent";
import CardTab from "../../Components/CardTab";
import {AppContext} from "../../AppContext";
import { useForm } from '@inertiajs/inertia-react'
import Topbar from "../../Layout/Topbar";

const tabs = [
    {id: 'email', title: translations['email'] + ' ' + translations['services']},
    {id: 'phone', title: translations['phone'] + ' ' + translations['services']}
];

const breadcrumb = [
    {
        title: translations['dashboard'],
        href: route('dashboard.index')
    }
];

const Services = (props) => {
    const {data} = useContext(AppContext);

    return (
        <>
            <Content>
                <Topbar title={props.pageTitle} breadcrumb={breadcrumb}/>
                <CardComponent title={props.pageTitle} tabs={tabs}>

                    <CardTab id={'email'}>
                        <div className="row">
                            <h1>HHHH</h1>
                        </div>
                    </CardTab>


                    <CardTab id={'phone'}>
                        <div className="row">
                            <h1>HHHH</h1>
                        </div>

                    </CardTab>

                </CardComponent>
            </Content>
        </>
    );
}


Services.layout = page => <Layout children={page}/>

export default Services;
