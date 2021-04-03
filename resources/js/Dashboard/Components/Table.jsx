import DataTable from 'react-data-table-component';
import DataTableExtensions from 'react-data-table-component-extensions';
import 'react-data-table-component-extensions/dist/index.css';
import {PaginationPerPageDefault} from "../Constants";
import { Inertia } from '@inertiajs/inertia'

const Table = ({data, columns, paginationServer=false, ...props}) => {
    return (
        <DataTableExtensions
            columns={columns}
            data={paginationServer ? data.data : data}
            filterPlaceholder={translations['search']}
            export={true}
            print={true}
        >
            <DataTable
                {...props}
                highlightOnHover={true}
                pagination={true}
                paginationTotalRows={paginationServer ? data.total : 0}
                paginationPerPage={paginationServer ? data.per_page : PaginationPerPageDefault}
                paginationServer={paginationServer}
                paginationDefaultPage={paginationServer ? data.current_page : 1}
                onChangePage={(page, totalRows) => {
                    if (!paginationServer) return;
                    Inertia.get(data.path, {page: page})
                }}
                onChangeRowsPerPage={(currentRowsPerPage, currentPage) => {
                    if (!paginationServer) return;
                    Inertia.get(data.path, {page: currentPage, perpage: currentRowsPerPage})
                }}
            />
        </DataTableExtensions>
    );
}

export default Table;
