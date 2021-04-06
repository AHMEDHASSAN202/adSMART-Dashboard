import react, {useContext} from 'react';
import Layout from "./../Layout/Layout";
import Topbar from './../Layout/Topbar';
import {AppContext} from "../AppContext";
import { InertiaLink } from '@inertiajs/inertia-react'
import Content from "../Layout/Content";

const Dashboard = (props) => {
    const {data, dispatch} = useContext(AppContext);

    return (
        <>
            <Topbar title={props.pageTitle} breadcrumb={[{title: 'About', href: '/dashboard/about'}]}>
                <InertiaLink href={'/dashboard'} className='btn btn-dark font-weight-bolder btn-sm'>
                    Add New
                </InertiaLink>
            </Topbar>
            <Content>
                <h1>Dashboard</h1>
            </Content>
        </>
    );
}


Dashboard.layout = page => <Layout children={page}/>

export default Dashboard;
