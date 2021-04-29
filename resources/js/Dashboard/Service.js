import HTTP from "../Common/HTTP";
import {GET_USERS_AND_GROUPS_URL, GROUPS_URL} from "./Constants";

class Service {
    static getAllGroups(user_token)
    {
        return HTTP.get(GROUPS_URL, {'auth_token': user_token});
    }

    static getAllMembers(user_token)
    {
        let url = GROUPS_URL + '/0/members';

        return HTTP.get(url, {'auth_token': user_token});
    }

    static getSpecificMembers(user_token, groupId)
    {
        let url = GROUPS_URL + '/'+ groupId +'/members';

        return HTTP.get(url, {'auth_token': user_token});
    }

    static deleteGroup(user_token, groupId)
    {
        let url = GROUPS_URL + '/' + groupId;

        return HTTP.delete(url, {'auth_token': user_token})
    }

    static updateGroup(user_token, groupId, data)
    {
        let url = GROUPS_URL + '/' + groupId;

        return HTTP.put(url, {'auth_token': user_token}, data);
    }

    static addGroup(user_token, data)
    {
        return HTTP.post(GROUPS_URL, {'auth_token': user_token}, data);
    }

    static getListOfUsersAndGroups(user_token, page)
    {
        let params = {
            'auth_token': user_token,
            'lang'      : currentLanguage.language_id,
            'page'      : page
        }
        return HTTP.get(GET_USERS_AND_GROUPS_URL, params);
    }

    static getMessages(url)
    {
        return HTTP.get(url);
    }
}

export default Service;
