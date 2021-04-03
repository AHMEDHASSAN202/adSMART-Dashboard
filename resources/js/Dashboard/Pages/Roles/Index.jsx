import react, {useContext, useState, useEffect} from 'react';
import Layout from "./../../Layout/Layout";
import Topbar from './../../Layout/Topbar';
import Content from "./../../Layout/Content";
import Table from "./../../Components/Table";
import DangerButton from "./../../Components/DangerButton";
import AddButton from "../../Components/AddButton";
import CardComponent from "../../Components/CardComponent";
import EditButton from "./../../Components/EditButton";

const breadcrumb = [
    {
        title: translations['dashboard'],
        href: route('dashboard.index')
    }
];

const Columns = [
    {
        name: translations['name'],
        selector: 'name',
        sortable: true,
    },
    {
        name: translations['actions'],
        selector: 'actions',
        cell: (row) => <EditButton href={route('dashboard.roles.edit', {role: row.role_id})}/>
    }
];

const Index = (props) => {
    const [selected, setSelected] = useState([]);
    const {roles} = props;

    return (
        <>
            <Topbar title={props.pageTitle} breadcrumb={breadcrumb}>
                <AddButton href={route('dashboard.roles.create')}/>
            </Topbar>
            <Content>
                <CardComponent title={props.pageTitle}>
                    <Table
                        noHeader={true}
                        columns={Columns}
                        data={roles}
                        keyField={'role_id'}
                        subHeader={true}
                        subHeaderComponent={<DangerButton href={route('dashboard.roles.destroy')} method='DELETE' data={{ids: selected}} disabled={selected.length < 1}/>}
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
