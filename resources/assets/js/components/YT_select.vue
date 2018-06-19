<template>
 <section class="section">
          <h3 class="is-size-5 has-text-info">Start by pasting the Youtube URL you'd like to use below</h3>
          <input @input="onInput" class="input is-rounded" type="text" placeholder="YouTube URL">
          <div>&nbsp;</div>
          <div v-if="stage">
            <img :src="'/images/tallSpacer.png'"  alt="" >
          </div>
          <p>{{ error }}</p>

          <article class="media">
              
            <figure class="media-left">
              <p class="image">
                <img :src="thumb">
              </p>
            </figure>

            <div class="media-content">
              <div class="content">
                <b-notification ref="element" :closable="false">
                <p>
                  <strong>{{ title }}</strong> 
                    <br>
                      {{ description }}
                </p>
              </b-notification>
              </div>
            </div>
          
          </article>
          <div>&nbsp;</div>
          
            <div class="questionblock" v-if="stage2">

              <div class="heading">Please select the question type.</div>
              <button v-on:click="questionType('A')"><img :src="'/images/q1.png'" alt="What happens next" ></button>
              <button v-on:click="questionType('B')"><img :src="'/images/q2.png'" alt="Video then question"></button>
              <button v-on:click="questionType('C')"><img :src="'/images/q3.png'" alt="Question then video" ></button>
              
            </div>

          <div>&nbsp;</div>

          <div v-if="stage3">
            Type of question chosen: <strong>{{ questionTypeShow }}</strong>
            <div>&nbsp;</div>
              <b-field label="Question to ask">
                <b-input placeholder="Question" v-model="questionValue"></b-input>
              </b-field>
              <b-field label="The correct answer">
                <b-input placeholder="Correct answer" v-model="answerValue"></b-input>
              </b-field>
              <b-field label="False answer one">
                <b-input placeholder="False answer one" v-model="falseOneValue"></b-input>
              </b-field>
              <b-field label="False answer two">
                <b-input placeholder="False answer two" v-model="falseTwoValue"></b-input>
              </b-field>
              <div>&nbsp;</div>
              <a class="button is-primary">Next</a>
              <youtube :video-id="VideoID" :player-vars="playerVars" @ended="ended"/>
          </div>

        </section>
</template>
<script>
const API_KEY ="AIzaSyCfGW2w8kCAiYH78LfnXJkTq1r-fBBa21Q";

  export default {  
     data: function(){
         return {
         title:' ',
         description:' ',
         thumb:'',
         error:' ',
         stage:false,
         stage2:false,
         stage3:false,
         questionTypeChose:'',
         questionTypeShow:'',
         isFullPage: false,
         questionValue:'',
         answerValue:'',
         falseOneValue:'',
         falseTwoValue:'',
         
          playerVars: {
                  autoplay: 1,
                  start: '',
                  end: '',
                  rel: 0,
                  controls: 0,
                  showinfo: 0,
          }
         }
      },
      methods:{
        onInput:function(event){
            this.title = ''
            this.description = ''
            this.thumb = ''
            var regExp = /^.*(youtu\.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
            var match = event.target.value.match(regExp);
            if (match && match[2].length == 11) {
              this.open();
              this.onChange();
              this.searchYT(match[2]);
            } else {
                this.error = 'Sorry - unable to search against that term';
                this.onChange();
                this.stage2=false;
                this.stage3=false;
            }
        },
        searchYT(VideoID){
            axios.get('https://www.googleapis.com/youtube/v3/search',{
                      params:{
                        key: API_KEY,
                        maxResults: '1',
                        type: 'video',
                        id: VideoID,
                        part: 'snippet',
                        q: VideoID,
                      }
                }).then(response=>{
                    this.error = '';
                    const videoData = response.data.items;
                    const items = []
                    for (let key in videoData){
                          const item = videoData[key]
                          item.id = key
                          items.push(item)
                      }
                    this.title = items[0].snippet.title
                    this.description = items[0].snippet.description
                    this.thumb = items[0].snippet.thumbnails.default.url
                });
        },
        open() {
                const loadingComponent = this.$loading.open({
                    container: this.isFullPage ? null : this.$refs.element.$el
                })
                setTimeout(() => loadingComponent.close(), 2 * 1000)
                this.stage2 = true
        },
        questionType(typeID){
              this.questionTypeChose=typeID;
              this.stage3 = true;

              if (typeID == 'A') {
                this.questionTypeShow = "What happens next";
                this.questionValue = "What happens next";
              }else if (typeID == 'B') {
                this.questionTypeShow = "Video followed by question";
                this.questionValue = "";
              }else{
                this.questionTypeShow = "Question followed by video";
                this.questionValue = "";
              };
        },
        onChange(){
          this.questionValue='';
          this.answerValue='';
          this.falseOneValue='';
          this.falseTwoValue='';
        },
        ended() {
          console.log('\o/ we have ended!!!')
        }

      }   
}
</script>