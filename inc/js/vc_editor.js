jQuery(document).ready(function ($) {
    'use strict';

    var i18n = window.dtb_i18nLocale;

      function remove_attach_video(event){

        event.preventDefault();

        var button=$(this),container=button.closest('.attach_video_field'),imagepreview=$('a.gallery_widget_add_video',container);
        var imgID=imagepreview.find('video').data('id'),input=container.find('input').val();

        if(input==''){
          input=new Array();
        }
        else{
          input=input.split(/,/);
        }
        for(var i = 0; i < input.length; i++) {
              if(input[i] == imgID) {
                input.splice(i, 1);
              }
        }

        imagepreview.html(imagepreview.attr('title'));
        container.find('input').val('').trigger('change');
        button.hide();
      }

      wp.media.DethemeVideoEdit = {
            getData:function () {
              return this.formfield.val();
            },
            set:function (selection) {

            if(this.getData()==selection.get('id')){
               return false;
            }

              var imagepreview=$('<video autoplay data-id="'+selection.get('id')+'" width="266"/>');
              var videosource=$('<source/>');

              var mime=selection.attributes.mime;
              var thumb=selection.attributes.thumb.src;
              videosource.attr('src',selection.attributes.url);
              videosource.attr('type',mime);
              imagepreview.attr('poster',thumb);
              imagepreview.append(videosource);
              this.preview.find('a.gallery_widget_add_video').html(imagepreview);
              this.formfield.val(selection.get('id')).trigger('change');

              this.field.find('.remove_attach_video').show();
              return false;
            },
          frame: function($field) {


          var button=$field.find('.gallery_widget_add_video'),remove_image=$field.find('.remove_attach_video'),
          formfield=$field.find('input'),preview=$field.find('.gallery_widget_attached_videos_list li');

          this.field=$field;
          this.formfield =$field.find('input');
          this.preview =preview;
          remove_image.click(remove_attach_video);

              if ( this._frame )
                  return this._frame;
       
              this._frame = wp.media({
                  id:         'insivia_image',               
                  state:      'insert-image',
                  title:      i18n.insert_video,
                  editing:    true,
                  multiple:   false,
                  toolbar:    'insert-image',
                  menu:'insert-image',
                  type : 'image',
                  states:[ new wp.media.controller.DethemeVideoEdit() ]

              });

                this._frame.on('toolbar:create:insert-image', function (toolbar) {
                    this.createSelectToolbar(toolbar, {
                        text:i18n.select_video
                    });
                }, this._frame);

                this._frame.state('insert-image').on('select', this.select);
              return this._frame;
          },
            select:function () {

                var selection = this.get('selection').single();
                wp.media.DethemeVideoEdit.set(selection ? selection : -1);
            }
      };



        wp.media.controller.DethemeVideoEdit = wp.media.controller.FeaturedImage.extend({
            defaults:_.defaults({
                id:'insert-image',
                filterable:'uploaded',
                multiple:false,
                toolbar:'insert-image',
                library:wp.media.query({type:'video'}),
                title:i18n.select_video,
                priority:60,
                syncSelection:false,
            }, wp.media.controller.Library.prototype.defaults),
            updateSelection:function () {
                var selection = this.get('selection'),
                    id = wp.media.DethemeVideoEdit.getData(),
                    attachment;

                if ('' !== id && -1 !== id) {
                    attachment = wp.media.model.Attachment.get( id );;
                    attachment.fetch();
                }
                selection.reset(attachment ? [ attachment ] : []);
            }
        });

      if($('.attach_video_field').length){
      $('.attach_video_field').each(function(){
      
      var element=$(this);

      element.find('.gallery_widget_add_video').unbind('click').click(function(){
         wp.media.DethemeVideoEdit.frame(element).open();
      });

      element.find('.remove_attach_video').unbind('click').click(remove_attach_video);

      });
    }

});