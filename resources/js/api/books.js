import axios from 'axios';

const client = axios.create({
  baseURL: '/api/books',
});

export default {
  all(page, callback) {
    const params = { page };

    return client.get('/', { params }).then(response => {
        callback(null, response.data);
    }).catch(error => {
        callback(error, error.response.data);
    });
  },
  find(id) {
    return client.get(`/${id}`);
  },
  create(data) {
    return client.post(`/created`, data);
  },
  update(id, data) {
    return client.put(`/${id}`, data);
  },
  delete(id) {
    return client.delete(`/${id}`);
  },
}
