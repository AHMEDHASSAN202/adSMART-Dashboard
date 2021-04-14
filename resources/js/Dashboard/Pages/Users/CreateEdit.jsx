import {useEffect, useContext} from 'react';
import Layout from "./../../Layout/Layout";
import Topbar from './../../Layout/Topbar';
import Content from "./../../Layout/Content";
import CardComponent from "../../Components/CardComponent";
import { useForm } from '@inertiajs/inertia-react'
import PrimaryButton from "../../Components/PrimaryButton";


const breadcrumb = [
    {
        title: translations['dashboard'],
        href: route('dashboard.index')
    },
    {
        title: translations['roles'],
        href: route('dashboard.users.index')
    }
];

const CreateEdit = (props) => {
    const {user} = props;
    const {
        data:formData,
        setData:setFormData,
        post,
        put,
        processing,
        errors
    } = useForm({})

    useEffect(() => {
        if (user) {
            //when edit
        }
    }, [])

    return (
        <>
            <Topbar title={props.pageTitle} breadcrumb={breadcrumb} >
                <PrimaryButton
                    classes={processing ? 'spinner spinner-white spinner-left spinner-sm' : ''}
                    disabled={processing}
                    onClick={() => user ? put(route('dashboard.users.update'), {preserveScroll: true}) : post(route('dashboard.users.store'), {preserveScroll: true})}>
                    {translations['save']}
                </PrimaryButton>
            </Topbar>

            <Content>
                <form id='roleForm' >
                     <div className='row'>

                         <div className="col-md-5">
                             <CardComponent title={'ddddd'}>

                             </CardComponent>
                         </div>

                        <div className='d-inline-block' style={{width: '20px'}}></div>

                         <div className="col-md-6">
                             <CardComponent title={'ddddd'}>

                             </CardComponent>
                         </div>

                    </div>
                </form>
            </Content>
        </>
    );
}


CreateEdit.layout = page => <Layout children={page}/>

export default CreateEdit;
