let v = new Vue({

  el: "#app",
  props: {
    msg: String
  },
  data: {
    edit: false,
    info: [],
    titles: [],
    focus: false,
    inputHour: null,
    count: 0
  },
  methods: {
    doubleClickForEdit: function (item) {
      item.edit = !item.edit;
    },
    getHoure: function (item) {
      let root = Object;
      for (const key in this.info[item]) {
        if (this.info[item].hasOwnProperty(key)) {
          const element = this.info[item][key];
          alert(element)
        }
      }
      //  console.log(root);
      return 1;
    },

    editHourReading: function (hour) {
      hour.edit = !hour.edit;
      console.log(hour)

    },
    saveHoure(item,hour) {
      let itemIndex = this.info[this.info.indexOf(item)][this.info[this.info.indexOf(item)].indexOf(hour)];
      console.log('Before_itemIndex',itemIndex)
      // console.log(item)
      // console.log(hour)
      let data = {
        id: hour.id,
        title_id: hour.title_id,
        read_time: this.inputHour
      };
      console.log('data', data)
      this.$http.post('http://localhost/plan/update.php', data,{
        emulateJSON: true
    }).then(function (response) {
        hour.edit = false;

        this.loading = false;

        itemIndex.read_time =(response.body.read_time);
      }, function (response) {
        console.log('Error!:', response.data);
        this.loading = false;
      });
    
    },
    showHourTime: function (hour) {
      console.log((hour.read_time != null) && (hour.edit == true))
      return (hour.read_time != null) && (hour.edit == true)
    },

    sumHour: function(item){
      let sum=0;
      for(let i=0;i<item.length;i++){
        if(item[i].read_time !=null){
          console.log(typeof item[i].read_time)
          sum += parseInt(item[i].read_time);
        }
      }
     return sum;

    }
  },
  computed: {

  },

  mounted: function () {

  },
  created: function () {

    // GET /someUrl

    // GET /someUrl
    this.$http.get('http://localhost/plan/show.php').then(response => {

      this.titles = response.body

      // console.log(response)
      //   this.info = response.body;
    }, response => {
      // console.log('error')
      // console.log(response)
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
        // console.log('out',outer)
        for (let index = 0; index < this.titles.length; index++) {
          if ((typeof outer[index]) == 'undefined') {
            // if( this.titles[index].id === outer[index].id ){
            // }else{
            // {0:'',id: index,read_time:null,created:null};
            // }
            outer.splice(index, 0, { 0: '', id: index + 1, read_time: null, created: null, edit: false })
          }

          outer[index].edit = false;

          

        }
        let spam = Array();
        // console.log('tite',this.titles)
        for (let index = 0; index < this.titles.length; index++) {
          if ((this.titles[index].title) == outer[index][0]) {
            // console.log('yes');
          } else {
            let isChanged = false;
            // console.log('false');
            // console.log('outer[index]',outer[index])
            //push current object in outer to spam array
            if (typeof outer[index] == 'undefined') {
              // console.log('unsifined')
              outer.splice(index, 0, { 0: '', id: index + 1, read_time: null, created: null, edit: false })
            }
            spam.push(outer[index]);

            //find this.title.title in outer array
            for (let i = 0; i < this.titles.length; i++) {
              if ((this.titles[index].title) == outer[i][0]) {
                outer[index] = outer[i];
                // console.log('index',index)
                // console.log('constCheck',this.titles[index].title)
                // console.log('variableCheck',outer[i][0])
                // console.log('outer(i)',outer[index].title)
                // console.log(i);

                isChanged = true;

              } else {
                for (let j = 0; j < spam.length; j++) {
                  if ((this.titles[index].title) == spam[j][0]) {
                    // console.log('index',index)

                    // console.log('constCheck',this.titles[index].title)
                    // console.log('variableCheck',spam[j][0])
                    // console.log('outer(index)',outer[index])
                    // console.log(`outer(j=${j})`,outer[index])

                    outer[index] = spam[j];

                    isChanged = true;

                  }
                }
              }
            }

            if (!isChanged) {
              outer[index] = { 0: '', id: index + 1, read_time: null, created: null, edit: false };
            }

          }
          // console.log('spam',spam)
          outer[index].title_id = index+1;
        }
        // console.log('888888888888888');
        for (const key in spam) {
          delete spam[key];
        }
        // console.log('newSpam',spam)

      });
      this.info = response.body;



      // console.log(response)
      //   this.info = response.body;
    }, response => {
      // console.log('error')
      // console.log(response)
      // error callback
    });
  }

});