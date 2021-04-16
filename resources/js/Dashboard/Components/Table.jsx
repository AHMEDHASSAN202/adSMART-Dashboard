import {useState, useEffect} from 'react';
import DataTable from 'react-data-table-component';
import {PaginationPerPageDefault} from "../Constants";
import { Inertia } from '@inertiajs/inertia'
import SearchComponent from "./SearchComponent";
import { usePage } from '@inertiajs/inertia-react'

const SubHeaderComponent = ({subHeaderComponent='', ...props}) => {
    return (
        <>
            <SearchComponent {...props} />
            {subHeaderComponent}
        </>
    )
}

const Table = ({data: d, columns, paginationServer=false, searchServer=false, subHeaderComponent, ...props}) => {
    const {props: {queries}} = usePage();
    const [data, setData] = useState(d);
    useEffect(() => {
        setData(d);
    }, [d])
    return (
        <>
            <DataTable
                {...props}
                data={paginationServer ? data.data : data}
                columns={columns}
                highlightOnHover={true}
                pagination={true}
                subHeader={true}
                subHeaderComponent={<SubHeaderComponent data={data} columns={columns} setDataFunction={setData} originalData={d} paginationServer={paginationServer} queries={queries} subHeaderComponent={subHeaderComponent} />}
                paginationTotalRows={paginationServer ? data.total : 0}
                paginationPerPage={paginationServer ? data.per_page : PaginationPerPageDefault}
                paginationServer={paginationServer}
                paginationDefaultPage={paginationServer ? data.current_page : 1}
                onChangePage={(page, totalRows) => {
                    if (!paginationServer) return;
                    Inertia.get(data.path, {page: page, ...queries})
                }}
                onChangeRowsPerPage={(currentRowsPerPage, currentPage) => {
                    if (!paginationServer) return;
                    Inertia.get(data.path, {page: currentPage, perpage: currentRowsPerPage, ...queries})
                }}
            />
        </>
    );
}

export default Table;
