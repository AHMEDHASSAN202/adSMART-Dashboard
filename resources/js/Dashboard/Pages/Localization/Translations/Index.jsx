import {useContext, useState, useEffect} from 'react';
import {AppContext} from "./../../../AppContext";
import Layout from "./../../../Layout/Layout";
import Topbar from './../../../Layout/Topbar';
import Content from "./../../../Layout/Content";
import Table from "./../../../Components/Table";
import {updateAlert} from "../../../actions";
import CardComponent from "../../../Components/CardComponent";

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

const Index = (props) => {
    const {data, dispatch} = useContext(AppContext);
    const [translationsWord, setTranslationsWord] = useState(props.translations)
    const [inputFocus, setInoutFocus] = useState('')
    const [status, setStatus] = useState('show')

    useEffect(() => {
        setTranslationsWord(props.translations);
    }, [])

    useEffect(() => {
        if (inputFocus) {
            document.getElementById(inputFocus).focus();
        }
    }, [translationsWord])

    useEffect(() => {
        if (status == 'update') {
            //call api
            axios.put(route('dashboard.translations.update'), {translations: translationsWord})
                .then((r) => {
                    if (r.data) {
                        setAlert(r.data.alert);
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000)
                    }
                }).catch(({response}) => {
                    if (response) {
                        setAlert(response.data.alert)
                    }
                })
        }
    } , [status])

    const setAlert = (alert) => {
        dispatch(updateAlert({icon: alert.icon, class: alert.class, title: alert.title}))
    }

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
                                <input type="text" id={inputId} className="form-control form-control-solid" value={translationsWord[rowKey][languageCode]} onChange={(e) => {
                                    let t = translationsWord;
                                    t[rowKey][languageCode] =  e.target.value;
                                    setTranslationsWord({...t});
                                    setInoutFocus(inputId);
                                }} />
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
                <EditButton status={status} setStatus={setStatus} />
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
