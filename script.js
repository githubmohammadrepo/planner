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






    this.$http.get('http://localhost/plan/index.php').then(response => {
  
      // get body data
    //   response.body.forEach(element => {
    //     element.edit = false;
    //   });
    // response.body.forEach(element => {
    //      this.titles.push(element[0]);
    //  });


     response.body.forEach(outer => {
        console.log('out',outer)
        
        for (let index = 0; index < this.titles.length; index++) {
          if((typeof  outer[index] )=='undefined'){
            // if( this.titles[index].id === outer[index].id ){
            // }else{
              // {0:'',id: index,read_time:null,created:null};
            // }
            outer.splice(index,0,{0:'',id: index,read_time:null,created:null})
          }
        }

        console.log('-s-')
        console.log(outer)
        console.log('-e-')
    });
    this.info = response.body;

      // console.log(response)
    //   this.info = response.body;
    }, response => {
        // console.log('error')
      console.log(response)
      // error callback
    });
  }

  });