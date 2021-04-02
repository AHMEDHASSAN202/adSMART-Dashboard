import react, {useContext, useState, useEffect} from 'react';
import Layout from "./../../../Layout/Layout";
import Topbar from './../../../Layout/Topbar';
import {AppContext} from "./../../../AppContext";
import Content from "./../../../Layout/Content";
import Table from "./../../../Components/Table";
import DangerButton from "./../../../Components/DangerButton";
import Columns from './LanguageCoulmns';
import AddButton from "../../../Components/AddButton";
import {setLanguages} from "../../../actions";
import CardComponent from "../../../Components/CardComponent";

const breadcrumb = [
    {
        title: translations['dashboard'],
        href: route('dashboard.index')
    }
];

const Index = (props) => {
    const {data, dispatch} = useContext(AppContext);
    const [selected, setSelected] = useState([]);
    useEffect(() => {
        dispatch(setLanguages(props.languages));
    }, [props.languages])
    return (
        <>
            <Topbar title={props.pageTitle} breadcrumb={breadcrumb}>
                <AddButton href={route('dashboard.languages.create')}/>
            </Topbar>
            <Content>
                <CardComponent title={props.pageTitle}>
                    <Table
                        noHeader={true}
                        columns={Columns}
                        data={data.languages}
                        keyField={'language_id'}
                        subHeader={true}
                        subHeaderComponent={<DangerButton href={route('dashboard.languages.destroy')} method='DELETE' data={{ids: selected}} disabled={selected.length < 1}/>}
                        selectableRows={true}
                        selectableRowsHighlight={true}
                        noContextMenu={true}
                        onSelectedRowsChange={(s) => {
                            let selectedRowsId = []
                            if (s.selectedCount) {
                                selectedRowsId = s.selectedRows.map((r) => r.language_id)
                            }
                            setSelected(selectedRowsId);
                        }}
                    />
                </CardComponent>
            </Content>
        </>
    );
}


Index.layout = page => <Layout children={page}/>

export default Index;
