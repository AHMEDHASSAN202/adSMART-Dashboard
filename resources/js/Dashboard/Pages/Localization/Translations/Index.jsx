import {useContext, useState, useEffect} from 'react';
import {AppContext} from "./../../../AppContext";
import Layout from "./../../../Layout/Layout";
import Topbar from './../../../Layout/Topbar';
import Content from "./../../../Layout/Content";
import Table from "./../../../Components/Table";
import CardComponent from "../../../Components/CardComponent";
import Permissions from "../../../Components/Permissions";

const breadcrumb = [
    {
        title: translations['dashboard'],
        href: route('dashboard.index')
    }
];

const EditButton = ({status, setStatus}) => (
    <button
        className="btn btn-dark font-weight-bolder btn-sm px-5"
        onClick={() => {
            switch (status) {
                case 'show':
                    setStatus('edit');
                    break;
                case 'edit':
                    setStatus('update');
                    break;
                case 'update':
                    setStatus('show');
                    break;
            }
        }}
    >
        <i className={'icon-md ' + ((status == 'edit' || status == 'update') ? 'flaticon2-add' : 'flaticon2-edit')} style={{marginRight: 3, marginBottom: 2}}></i>
        {(status == 'edit' || status == 'update') ? translations['save'] : translations['edit']}
    </button>
)

const handleTranslationData = (translationsProps) => {
    return Object.keys(translationsProps).map((key, i) => {
        return {key, ...translationsProps[key], i}
    })
}

const MyInput = ({inputId, translations, rowKey, languageCode, setTranslationsWord}) => {
    return (
        <input type="text" id={inputId} className="form-control form-control-solid" value={translations[rowKey][languageCode] || ''} onChange={(e) => {
            let t = translations;
            t[rowKey][languageCode] =  e.target.value;
            setTranslationsWord({...t});
            setTimeout(() => document.getElementById(inputId)?.focus(), 0)
        }} />
    )
}

const Index = (props) => {
    const {data} = useContext(AppContext);
    const [translationsWord, setTranslationsWord] = useState(props.translations)
    const [status, setStatus] = useState('show')

    useEffect(() => {
        if (status == 'update') {
            //call api
            axios.put(route('dashboard.translations.update'), {translations: translationsWord})
                .then((r) => {
                    if (r.data) {
                        window.location.reload();
                    }
                })
        }
    } , [status])

    const columns = data.languages.map((lang) => {
        return {
            name: lang.language_name,
            selector: lang.language_code,
            sortable: true,
            cell: (row) => {
                let rowKey = row.key;
                let languageCode = lang.language_code;
                let inputId = 'input-word-' + rowKey + '-' + languageCode;
                return (
                    <>
                        {translationsWord && (status == 'edit') ?
                            <div className="form-group mb-0">
                               <MyInput
                                   inputId={inputId}
                                   translations={translationsWord}
                                   rowKey={rowKey}
                                   languageCode={languageCode}
                                   setTranslationsWord={setTranslationsWord}
                               />
                            </div> : <div>{row[languageCode]}</div>
                        }
                    </>
                )
            }
        };
    })

    return (
        <>
            <Topbar title={props.pageTitle} breadcrumb={breadcrumb} >
                <Permissions hasPermissions={['localization-update']}>
                    <EditButton status={status} setStatus={setStatus} />
                </Permissions>
            </Topbar>
            <Content>
                <CardComponent title={props.pageTitle}>
                    <Table
                        noHeader={true}
                        columns={columns}
                        data={handleTranslationData(props.translations)}
                        keyField={'i'}
                        selectableRows={true}
                        selectableRowsHighlight={true}
                        noContextMenu={true}
                    />
                </CardComponent>
            </Content>
        </>
    );
}


Index.layout = page => <Layout children={page}/>

export default Index;
