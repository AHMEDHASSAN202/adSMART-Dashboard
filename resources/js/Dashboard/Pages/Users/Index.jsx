import react, {useContext, useState, useEffect} from 'react';
import Layout from "./../../Layout/Layout";
import Topbar from './../../Layout/Topbar';
import Content from "./../../Layout/Content";
import Table from "./../../Components/Table";
import DangerButton from "./../../Components/DangerButton";
import AddButton from "../../Components/AddButton";
import CardComponent from "../../Components/CardComponent";
import EditButton from "./../../Components/EditButton";
import Permissions from "../../Components/Permissions";

const breadcrumb = [
    {
        title: translations['dashboard'],
        href: route('dashboard.index')
    }
];

const Columns = [
    {
        name: translations['avatar'],
        sortable: false,
        cell: (row) => <div className={'symbol symbol-50 symbol-fixed my-2'}><img src={row.user_avatar_full_path} alt={row.user_name} className={'symbol-label'} /></div>
    },
    {
        name: translations['name'],
        selector: 'user_name',
        sortable: true,
    },
    {
        name: translations['email'],
        selector: 'user_email',
        sortable: false,
    },
    {
        name: translations['role'],
        selector: 'role.name',
        sortable: false,
    },
    {
        name: translations['actions'],
        selector: 'actions',
        cell: (row) => <Permissions hasPermissions={['users-update']}><EditButton href={route('dashboard.users.edit', {user: row.user_id})}/></Permissions>
    }
];

const Index = (props) => {
    const [selected, setSelected] = useState([]);
    const {users} = props;

    return (
        <>
            <Topbar title={props.pageTitle} breadcrumb={breadcrumb}>
                <Permissions hasPermissions={['users-create']}>
                    <AddButton href={route('dashboard.users.create')}/>
                </Permissions>
            </Topbar>
            <Content>
                <CardComponent title={props.pageTitle}>
                    <Table
                        noHeader={true}
                        columns={Columns}
                        data={users}
                        keyField={'user_id'}
                        subHeaderComponent={<Permissions hasPermissions={['users-delete']}><DangerButton href={route('dashboard.users.destroy')} method='DELETE' data={{ids: selected}} disabled={selected.length < 1}/></Permissions>}
                        selectableRows={true}
                        selectableRowsHighlight={true}
                        noContextMenu={true}
                        onSelectedRowsChange={(s) => {
                            let selectedRowsId = []
                            if (s.selectedCount) {
                                selectedRowsId = s.selectedRows.map((r) => r.role_id)
                            }
                            setSelected(selectedRowsId);
                        }}
                        paginationServer={true}
                    />
                </CardComponent>
            </Content>
        </>
    );
}


Index.layout = page => <Layout children={page}/>

export default Index;
