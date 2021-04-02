import DataTable from 'react-data-table-component';
import DataTableExtensions from 'react-data-table-component-extensions';
import 'react-data-table-component-extensions/dist/index.css';

const Table = ({data, columns, ...props}) => {
    return (
        <DataTableExtensions columns={columns} data={data} filterPlaceholder={translations['search']}>
            <DataTable
                {...props}
                highlightOnHover={true}
                pagination={true}
            />
        </DataTableExtensions>
    );
}

export default Table;
