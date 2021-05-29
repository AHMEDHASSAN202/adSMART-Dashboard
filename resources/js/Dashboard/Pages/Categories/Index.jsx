import {useState, useEffect} from 'react';
import Layout from "./../../Layout/Layout";
import Topbar from './../../Layout/Topbar';
import Content from "./../../Layout/Content";
import Table from "./../../Components/Table";
import DangerButton from "./../../Components/DangerButton";
import AddButton from "../../Components/AddButton";
import CardComponent from "../../Components/CardComponent";
import EditButton from "./../../Components/EditButton";
import Permissions from "../../Components/Permissions";
import TreeComponent from "../../Components/TreeComponent";
import {getTreeFromFlatData} from 'react-sortable-tree';
import PrimaryButton from "../../Components/PrimaryButton";
import { useForm } from '@inertiajs/inertia-react'

const breadcrumb = [
    {
        title: translations['dashboard'],
        href: route('dashboard.index')
    }
];

const Columns = [
    {
        name: translations['name'],
        selector: 'category_name',
        sortable: true,
    },
    {
        name: translations['actions'],
        selector: 'actions',
        cell: (row) => <Permissions hasPermissions={['categories-update']}><EditButton href={route('dashboard.categories.edit', {category_id: row.category_id})}/></Permissions>,
        width: '80px'
    }
];

const Index = (props) => {
    const [selected, setSelected] = useState([]);
    const {categories} = props;
    const { data: formData, setData, processing, put} = useForm({sortable_categories: []})
    useEffect(() => {
        let flatCategories = categories.map((cat) => {
            return {
                category_id: cat.category_id,
                title: cat.category_name,
                subtitle: cat.category_slug,
                sort_order: cat.sort_order,
                parent_id: cat.parent_id,
            }
        })
        let c = getTreeFromFlatData({
            flatData: flatCategories,
            getKey: (node) => node.category_id,
            getParentKey: (node) => node.parent_id,
            rootKey: null
        });
        setData('sortable_categories', c);
    } , [])
    return (
        <>
            <Topbar title={props.pageTitle} breadcrumb={breadcrumb}>
                <Permissions hasPermissions={['categories-create']}>
                    <AddButton href={route('dashboard.categories.create')}/>
                </Permissions>
            </Topbar>
            <Content>
                <div className="row">
                    <div className="col-md-6 col-sm-12">
                        <CardComponent title={props.pageTitle}>
                            <Table
                                noHeader={true}
                                columns={Columns}
                                data={categories}
                                keyField={'category_id'}
                                subHeaderComponent={<Permissions hasPermissions={['categories-delete']}><DangerButton href={route('dashboard.categories.destroy')} method='DELETE' data={{ids: selected}} disabled={selected.length < 1}/></Permissions>}
                                selectableRows={true}
                                selectableRowsHighlight={true}
                                noContextMenu={true}
                                onSelectedRowsChange={(s) => {
                                    let selectedRowsId = []
                                    if (s.selectedCount) {
                                        selectedRowsId = s.selectedRows.map((r) => r.category_id)
                                    }
                                    setSelected(selectedRowsId);
                                }}
                                paginationServer={false}
                            />
                        </CardComponent>
                    </div>
                    <div className="col-md-6 col-sm-12">
                        <CardComponent
                            title={translations['sort']}
                            footer={
                                <PrimaryButton
                                    classes={processing ? 'spinner spinner-white spinner-left spinner-sm' : ''}
                                    onClick={() => {
                                        put(route('dashboard.categories.sort'), {preserveScroll: true});
                                    }}
                                    disabled={processing || formData == null}
                                >
                                    {translations['save']+ ' ' +translations['sort']}
                                </PrimaryButton>
                            }
                        >
                            <TreeComponent
                                treeData={formData.sortable_categories}
                                onChange={(treeData) => {
                                    setData('sortable_categories', treeData);
                                }}
                                getNodeKey={({node}) => node.category_id}
                            />
                        </CardComponent>
                    </div>
                </div>
            </Content>
        </>
    );
}


Index.layout = page => <Layout children={page}/>

export default Index;
