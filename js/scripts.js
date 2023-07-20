const { createApp } = Vue;

const app = createApp({
  data() {
    return {
      apiUrl: "http://localhost/php-todo-list-json/api/tasks/",
      tasks: [],
      newTask: "",
    };
  },
  methods: {
    // metodo per una chiamata con POST per pushare la nuova task da aggiungere al DB
    addTask() {
      const data = { task: this.newTask };

      //devo preparare una configurazione per dire che tipo di
      const config = {
        headers: { "Content-type": "multipart/form-data" },
      };
      axios.post(this.apiUrl, data, config).then((res) => {
        this.tasks.push(res.data);
        this.newTask = "";
      });
    },
  },
  created() {
    //chiamata axios della API
    axios.get(this.apiUrl).then((res) => {
      this.tasks = res.data;
    });
  },
});
app.mount("#app");
