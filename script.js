let v = new Vue({

    el: "#app",
    props: {
      msg: String
    },
    data:{
        edit: false,
        info: [],
        titles: [],
    },
    methods: {
      doubleClickForEdit: function(item){
        item.edit = !item.edit;
      },
      getHoure: function(item){
        let root = Object;
        for (const key in this.info[item]) {
            if (this.info[item].hasOwnProperty(key)) {
                const element = this.info[item][key];
                alert(element)
            }
        }
         console.log(root);
         return 1;
    }
    },
    computed: {
        
    },
    
    created: function() {
      
        // GET /someUrl
        this.$http.get('http://localhost/plan/index.php').then(response => {
  
          // get body data
        //   response.body.forEach(element => {
        //     element.edit = false;
        //   });
        // response.body.forEach(element => {
        //      this.titles.push(element[0]);
        //  });


        //  response.body.forEach(element => {
        //     this.info.push(element['read_time']);
        // });
        this.info = response.body;

          console.log(response)
        //   this.info = response.body;
        }, response => {
            console.log('error')
          console.log(response)
          // error callback
        });
    // GET /someUrl
        this.$http.get('http://localhost/plan/show.php').then(response => {
  
         this.titles = response.body;

          console.log(response)
        //   this.info = response.body;
        }, response => {
            console.log('error')
          console.log(response)
          // error callback
        });
    }
  });