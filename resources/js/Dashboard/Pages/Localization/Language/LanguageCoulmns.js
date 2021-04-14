import EditButton from "./../../../Components/EditButton";
import Checkbox from "./../../../Components/Checkbox";
import { Inertia } from '@inertiajs/inertia'
import Permissions from "../../../Components/Permissions";

const Columns = [
    {
        name: translations['name'],
        selector: 'language_name',
        sortable: true,
    },
    {
        name: translations['code'],
        selector: 'language_code',
        sortable: true,
    },
    {
        name: translations['direction'],
        selector: 'language_direction',
        sortable: true,
    },
    {
        name: translations['display_front'],
        selector: 'language_display_front',
        cell: (row) => <Permissions hasPermissions={['localization-update']}>
            <Checkbox checked={row.language_display_front} onChange={() => {
                Inertia.put(
                    route('dashboard.languages.toggle_display_front', {language: row.language_id}),
                    {
                        preserveScroll: true,
                    }
                )
            }}/>
        </Permissions>
    },
    {
        name: translations['actions'],
        selector: 'actions',
        cell: (row) => <Permissions hasPermissions={['localization-update']}><EditButton href={route('dashboard.languages.edit', {languageId: row.language_id})}/></Permissions>
    },

];

export default Columns;
