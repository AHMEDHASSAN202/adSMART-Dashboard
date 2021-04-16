import {useState} from 'react';
import Layout from "./../../Layout/Layout";
import Topbar from './../../Layout/Topbar';
import Content from "./../../Layout/Content";
import Table from "./../../Components/Table";
import DangerButton from "./../../Components/DangerButton";
import CardComponent from "../../Components/CardComponent";
import Permissions from "../../Components/Permissions";
import EditIconButton from "../../Components/EditIconButton";
import {useForm} from "@inertiajs/inertia-react";
import InvalidFeedBack from "../../Components/InvalidFeedback";
import PrimaryButton from "../../Components/PrimaryButton";
import {generateSlug} from "../../helpers";

const breadcrumb = [
    {
        title: translations['dashboard'],
        href: route('dashboard.index')
    }
];

const Columns = (setDataFunction) => {
    return [
        {
            name: translations['name'],
            selector: 'type_value',
            sortable: true,
        },
        {
            name: translations['actions'],
            selector: 'actions',
            cell: (row) => <Permissions hasPermissions={['types-update']}>
                <EditIconButton onClick={() => {
                    let {type_id, type_slug, type_value} = row;
                    setDataFunction({type_id, type_slug, type_value})
                }}/>
            </Permissions>
        }
    ]
};

const Index = (props) => {
    const [selected, setSelected] = useState([]);
    const {types, type_key} = props;
    const typeObject = {
        type_id: null,
        type_key: type_key,
        type_slug: '',
        type_value: '',
    };
    const { data: formData, setData, processing, post, put, errors, reset} = useForm(typeObject);

    return (
        <>
            <Topbar title={props.pageTitle} breadcrumb={breadcrumb} />
            <Content>
                <div className="row">
                    <div className="col-md-5">
                        <CardComponent
                            title={translations['add'] + ' ' + translations['type']}
                            footer={
                                <div>
                                    <PrimaryButton
                                        classes={processing ? 'spinner spinner-white spinner-left spinner-sm' : ''}
                                        disabled={processing || formData.type_value == '' || formData.type_slug == ''}
                                        onClick={() => {
                                            if (formData.type_id != null) {
                                                put(route('dashboard.types.update', {type_id: formData.type_id}), {
                                                    preserveScroll: true,
                                                    onSuccess: visit => { reset() }
                                                })
                                            }else {
                                                post(route('dashboard.types.store'), {
                                                    preserveScroll: true,
                                                    onSuccess: visit => { reset() }
                                                })
                                            }
                                        }
                                        }
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
                                        className={'form-control' + (errors.type_value ? ' is-invalid' : '')}
                                        type="text"
                                        value={formData.type_value || ''}
                                        id="title"
                                        onChange={(e) => {
                                            let o = {type_value: e.target.value, type_slug: generateSlug(e.target.value)};
                                            setData({...formData, ...o});
                                        }}
                                    />
                                    <InvalidFeedBack msg={errors.type_value}/>
                                </div>
                            </div>
                            <div className="form-group row">
                                <label className="col-md-3 col-sm-12 col-form-label" htmlFor="slug">{translations['slug']}</label>
                                <div className="col-md-9 col-sm-12">
                                    <input
                                        className={'form-control' + (errors.type_slug ? ' is-invalid' : '')}
                                        type="text"
                                        value={formData.type_slug || ''}
                                        id="slug"
                                        onChange={(e) => {
                                            setData('type_slug', generateSlug(e.target.value))
                                        }}
                                    />
                                    <InvalidFeedBack msg={errors.type_slug}/>
                                </div>
                            </div>
                        </CardComponent>
                    </div>
                    <div className="col-md-7">
                        <CardComponent title={props.pageTitle}>
                            <Table
                                noHeader={true}
                                columns={Columns(setData)}
                                data={types}
                                keyField={'type_id'}
                                subHeaderComponent={<Permissions hasPermissions={['types-delete']}><DangerButton href={route('dashboard.types.destroy')} method='DELETE' data={{ids: selected}} disabled={selected.length < 1}/></Permissions>}
                                selectableRows={true}
                                selectableRowsHighlight={true}
                                noContextMenu={true}
                                onSelectedRowsChange={(s) => {
                                    let selectedRowsId = []
                                    if (s.selectedCount) {
                                        selectedRowsId = s.selectedRows.map((r) => r.type_id)
                                    }
                                    setSelected(selectedRowsId);
                                }}
                                paginationServer={false}
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
