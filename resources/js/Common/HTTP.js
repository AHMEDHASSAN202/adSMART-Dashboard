class HTTP {
    static get(url, params= {}, config={}) {
        let queryParams = HTTP.handleParams(params);
        return axiosInstanceWithoutCommonHeaders.get(url + queryParams, config)
    }

    static post(url, params= {}, body={}, config={})
    {
        let queryParams = HTTP.handleParams(params);
        return axiosInstanceWithoutCommonHeaders.post(url + queryParams, body, config);
    }

    static put(url, params= {}, body={}, config={})
    {
        let queryParams = HTTP.handleParams(params);
        return axiosInstanceWithoutCommonHeaders.put(url + queryParams, body, config);
    }

    static patch(url, params= {}, body={}, config={})
    {
        let queryParams = HTTP.handleParams(params);
        return axiosInstanceWithoutCommonHeaders.patch(url + queryParams, body, config);
    }

    static delete(url, params= {}, config={})
    {
        let queryParams = HTTP.handleParams(params);
        return axiosInstanceWithoutCommonHeaders.delete(url + queryParams, config);
    }

    static handleParams(params= {})
    {
        let queryParams = '';
        if (Object.keys(params).length) {
            queryParams = '?';
            Object.keys(params).forEach((param) => {
                queryParams += String(param) + '=' + String(params[param]) + '&';
            })
            queryParams = queryParams.slice(0, -1);
        }
        return queryParams;
    }
}

export default HTTP;
