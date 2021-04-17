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
        name: translations['title'],
        selector: 'page_title',
        sortable: true,
    },
    {
        name: translations['slug'],
        selector: 'page_slug',
        sortable: true,
    },
    {
        name: translations['type'],
        selector: 'type_value',
        sortable: true,
    },
    {
        name: translations['actions'],
        selector: 'actions',
        cell: (row) => <Permissions hasPermissions={['pages-update']}><EditButton href={route('dashboard.pages.edit', {page_id: row.page_id})}/></Permissions>
    }
];

const Index = (props) => {
    const [selected, setSelected] = useState([]);
    const {pages} = props;

    return (
        <>
            <Topbar title={props.pageTitle} breadcrumb={breadcrumb}>
                <Permissions hasPermissions={['pages-create']}>
                    <AddButton href={route('dashboard.pages.create')}/>
                </Permissions>
            </Topbar>
            <Content>
                <CardComponent title={props.pageTitle}>
                    <Table
                        noHeader={true}
                        columns={Columns}
                        data={pages}
                        keyField={'role_id'}
                        subHeaderComponent={<Permissions hasPermissions={['pages-delete']}><DangerButton href={route('dashboard.pages.destroy')} method='DELETE' data={{ids: selected}} disabled={selected.length < 1}/></Permissions>}
                        selectableRows={true}
                        selectableRowsHighlight={true}
                        noContextMenu={true}
                        onSelectedRowsChange={(s) => {
                            let selectedRowsId = []
                            if (s.selectedCount) {
                                selectedRowsId = s.selectedRows.map((r) => r.page_id)
                            }
                            setSelected(selectedRowsId);
                        }}
                        paginationServer={false}
                    />
                </CardComponent>
            </Content>
        </>
    );
}


Index.layout = page => <Layout children={page}/>

export default Index;
