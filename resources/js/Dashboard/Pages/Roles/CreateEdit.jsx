import {useEffect, useContext} from 'react';
import Layout from "./../../Layout/Layout";
import Topbar from './../../Layout/Topbar';
import Content from "./../../Layout/Content";
import SubmitButton from "../../Components/SubmitButton";
import InvalidFeedBack from "../../Components/InvalidFeedback";
import CardComponent from "../../Components/CardComponent";
import { useForm } from '@inertiajs/inertia-react'
import {AppContext} from "../../AppContext";
import CardTab from "../../Components/CardTab";
import {formBuilder, getFromObject, getLanguagesTabs, myIf} from "../../helpers";
import Checkbox from "../../Components/Checkbox";


const breadcrumb = [
    {
        title: translations['dashboard'],
        href: route('dashboard.index')
    },
    {
        title: translations['languages'],
        href: route('dashboard.roles.index')
    }
];

const CreateEdit = (props) => {
    const {data} = useContext(AppContext)
    const {languages} = data;
    const { data: formData, setData} = useForm(
        formBuilder(languages, {role_name: '', permissions: []}, ['role_name'])
    );
    const tabs = getLanguagesTabs(languages);
    const {permissions, role} = props

    useEffect(() => {
        if (role) {
            //when edit
            const {role_name, permissions} = role;
            setData({role_name, permissions});
        }
    }, [])

    return (
        <>
            <Topbar title={props.pageTitle} breadcrumb={breadcrumb} >
                <SubmitButton href={role ? route('dashboard.roles.update', role.role_id) : route('dashboard.roles.store')}
                              data={formData}
                              method={role ? 'PUT' : 'POST'}
                              title={translations['save']}
                              form='roleForm'
                              disabled={Object.values(formData.role_name).includes('')}
                />
            </Topbar>

            <Content>
                <form id='roleForm' >
                     <div className='row'>

                         <div className="col-md-5">
                             <CardComponent title={translations['role']} tabs={tabs}>
                                 {tabs.map((tab, i) => (
                                     <CardTab key={i} id={tab.id}>
                                         <div className="form-group">
                                             <label>{translations['name']}</label>
                                             <input required min={3} max={100} type="text" onChange={(e) => setData('role_name', {...formData.role_name, [tab.id]: e.target.value}) } value={formData.role_name[tab.id]} className={'form-control ' + myIf(props.errors, 'role_name.'+tab.id, 'is-invalid', '')} />
                                             <InvalidFeedBack msg={getFromObject(props.errors, 'role_name.'+tab.id)} />
                                         </div>
                                     </CardTab>
                                 ))}
                             </CardComponent>
                         </div>

                        <div className='d-inline-block' style={{width: '20px'}}></div>

                         <div className="col-md-6">
                             <CardComponent title={translations['permissions']}>
                                 <div className="row">
                                     {Object.keys(permissions).map((permissionsGroup, i) => (
                                         <div className="col-md-6" key={permissionsGroup+i}>
                                             <div className="form-group">
                                                 <label>{translations[permissionsGroup] || permissionsGroup}</label>
                                                 <div className="checkbox-list">
                                                     {permissions[permissionsGroup].map((permission, ii) => (
                                                         <Checkbox
                                                             key={permissionsGroup+permission+ii}
                                                             checked={formData.permissions.includes(permissionsGroup + '-' + permission)}
                                                             label={translations[permission] || permission}
                                                             onChange={(e) => {
                                                                 let prs = formData.permissions;
                                                                 let index = prs.indexOf(permissionsGroup + '-' + permission);
                                                                 if (index == -1) {
                                                                     prs.push(permissionsGroup + '-' + permission);
                                                                 }else {
                                                                     prs.splice(index, 1);
                                                                 }
                                                                 setData('permissions', [...prs])
                                                             }}
                                                         />
                                                     ))}
                                                 </div>
                                             </div>
                                         </div>
                                     ))}
                                 </div>
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
