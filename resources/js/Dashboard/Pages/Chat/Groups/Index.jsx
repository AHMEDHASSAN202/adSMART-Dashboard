import {useEffect, useState} from 'react';
import Layout from "./../../../Layout/Layout";
import Topbar from './../../../Layout/Topbar';
import Content from "./../../../Layout/Content";
import Table from "./../../../Components/Table";
import CardComponent from "../../../Components/CardComponent";
import {useForm, usePage} from "@inertiajs/inertia-react";
import InvalidFeedBack from "../../../Components/InvalidFeedback";
import PrimaryButton from "../../../Components/PrimaryButton";
import Loading from "../../../Components/Loading";
import EditIconButton from "../../../Components/EditIconButton";
import DeleteIconButton from "../../../Components/DeleteIconButton";
import UsersSelectComponent from "../../../Components/UsersSelectComponent";
import {Group} from "../../../helpers";
import Service from "../../../Service";

const breadcrumb = [
    {
        title: translations['dashboard'],
        href: route('dashboard.index')
    },
    {
        title: translations['chat'],
        href: route('dashboard.chat.index')
    }
];

const Columns = (auth_id, editFunction, deleteFunction) => {
    return [
        {
            name: translations['name'],
            selector: 'group_name',
            sortable: true,
        },
        {
            name: translations['created_by'],
            selector: 'created_by_name',
            sortable: true,
        },
        {
            name: translations['members'] + ' ' + translations['count'],
            selector: 'count_users',
            sortable: true,
            width: '70px'
        },
        {
            name: translations['actions'],
            selector: 'actions',
            cell: (row) => {
                if (row.fk_created_by !== auth_id) return '';
                return (
                    <>
                        <EditIconButton onClick={() => editFunction(row)} />
                        <DeleteIconButton onClick={() => deleteFunction(row)} />
                    </>
                )
            }
        }
    ]
};

const Index = (props) => {
    const {auth: {user_token, ...auth}} = usePage().props;
    const { data: formData, setData, errors, reset} = useForm(new Group());
    const [groups, setGroups] = useState([]);
    const [users, setUsers] = useState([]);
    const [loading, setLoading] = useState(false);
    const [processing, setProcessing] = useState(false);
    const [updatedList, setUpdatedList] = useState(false);

    const refreshList = () => setUpdatedList(!updatedList);
    const deleteGroup = (row) => Service.deleteGroup(user_token, row.group_id).then(r => refreshList());
    const editGroup = (row) => {
        let edit = new Group();
        edit.group_id = row.group_id;
        edit.group_name = row.group_name;
        Service.getSpecificMembers(user_token, row.group_id)
                .then(({data}) => {
                    let members = [];
                    data.members.forEach(v => {
                        members.push(v.user_id)
                    });
                    edit.members = members;
                    setData(edit);
                })
    }
    const addGroup = () => {
        setProcessing(true);
        Service.addGroup(user_token, formData)
                .then(r => {reset(); refreshList();})
                .finally(() => setProcessing(false))
    }
    const updateGroup = () => {
        setProcessing(true);
        Service.updateGroup(user_token, formData.group_id, formData)
                .then(r => {reset(); refreshList();})
                .finally(() => setProcessing(false))
    }

    useEffect(() => {
        setLoading(true);
        Service.getAllGroups(user_token)
                .then(({data}) => {
                    setGroups(data.groups);
                })
                .finally(() => setLoading(false))
    }, [updatedList])

    useEffect(() => {
        Service.getAllMembers(user_token)
                .then(({data}) => {
                    setUsers(data.members);
                })
    }, [])

    return (
        <>
            <Topbar title={props.pageTitle} breadcrumb={breadcrumb} />
            <Content>
                <div className="row">
                    <div className="col-md-5">
                        <CardComponent
                            title={(formData.group_id ? translations['update'] : translations['add']) + ' ' + translations['group']}
                            footer={
                                <div>
                                    <PrimaryButton
                                        classes={processing ? 'spinner spinner-white spinner-left spinner-sm' : ''}
                                        disabled={processing || formData.group_name == ''}
                                        onClick={() => formData.group_id != null ? updateGroup() : addGroup()}
                                    >
                                        {translations['save']}
                                    </PrimaryButton>
                                    <button
                                        className='btn btn-secondary font-weight-bolder text-uppercase mx-3'
                                        onClick={() => reset()}
                                    >{translations['reset']}</button>
                                </div>
                            }
                        >
                            <div className="form-group row">
                                <label className="col-md-3 col-sm-12 col-form-label" htmlFor="title">{translations['name']}</label>
                                <div className="col-md-9 col-sm-12">
                                    <input
                                        className={'form-control' + (errors.group_name ? ' is-invalid' : '')}
                                        type="text"
                                        value={formData.group_name}
                                        id="title"
                                        onChange={(e) => setData('group_name', e.target.value)}
                                    />
                                    <InvalidFeedBack msg={errors.group_name}/>
                                </div>
                            </div>
                            <div className="form-group row">
                                <label className="col-md-3 col-sm-12 col-form-label" htmlFor="title">{translations['members']}</label>
                                <div className="col-md-9 col-sm-12">
                                    <UsersSelectComponent
                                        onChange={(value, { action, removedValue }) => {
                                            let ids = value.map(v => v.user_id);
                                            setData('members', ids)
                                        }}
                                        options={users}
                                        value={users.filter(user => formData.members.includes(user.user_id))}
                                    />
                                    <InvalidFeedBack msg={errors.members}/>
                                </div>
                            </div>
                        </CardComponent>
                    </div>
                    <div className="col-md-7">
                        <CardComponent title={props.pageTitle}>
                            {loading
                                ? <Loading />
                                : <Table
                                    noHeader={true}
                                    columns={Columns(auth.user_id, editGroup, deleteGroup)}
                                    data={groups}
                                    keyField={'group_id'}
                                    selectableRows={false}
                                    selectableRowsHighlight={false}
                                    noContextMenu={true}
                                    paginationServer={false}
                                />
                            }
                        </CardComponent>
                    </div>
                </div>
            </Content>
        </>
    );
}


Index.layout = page => <Layout children={page}/>

export default Index;
