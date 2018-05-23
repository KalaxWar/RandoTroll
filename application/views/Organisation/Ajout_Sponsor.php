<?php if (!(isset($LeSponso['NOM']))) {echo '</div>';}?>
<div class='col-sm-5' >
<section>
<div class="section-inner" style="background-color:#FDBA23;padding:20px;">
<script>
  $( function() {
    $.widget( "custom.combobox2", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox2" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox2-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            classes: {
              "ui-tooltip": "ui-state-highlight"
            }
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -2 )
          .attr( "title", "")
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox2-toggle ui-corner-right" )
          .on( "mousedown", function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .on( "click", function() {
            input.trigger( "focus" );
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title","Aucun contributeur trouvé" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
 
    $( "#combobox2" ).combobox();
    $( "#toggle" ).on( "click", function() {
      $( "#combobox2" ).toggle();
    });
  } );
  </script>
<?php if (isset($LeSponso['NOM'])) {echo '<h3 align="center"><span class="textBlanc">Modifier un sponsor</span></h3>';}
else {
    echo "<h3 align='center'><span class='textBlanc'>Créer un sponsor</span></h3>";
}?>
<p class='textBlanc' align='center'>* = mention obligatoire</p>
<?php
   echo form_open('Administrateur_Organisation/Gestion_Sponsor'); // j'ouvre mon form
?>
<br>
<p align='center'> 
<input type="hidden" name="nosponsor" <?php if (isset($LeSponso['NOSPONSOR'])) {echo 'value="'.$LeSponso['NOSPONSOR'].'"';}?>>
    <label for="txtNom"><span class='textBlanc'>Nom : *</span></label>
    <input type="text" name='txtNom' class='form-control' required <?php if (isset($LeSponso['NOM'])) {echo 'value="'.$LeSponso['NOM'].'"';}?>>
    <label for="txtAdresse"><span class='textBlanc'>Adresse : </span></label>
    <input type="text" name='txtAdresse' class='form-control'  <?php if (isset($LeSponso['ADRESSE'])) {echo 'value="'.$LeSponso['ADRESSE'].'"';}?>>
    <label for="txtCP"><span class='textBlanc'>Code postal : </span></label>
    <input type="text" name='txtCP' class='form-control'  <?php if (isset($LeSponso['CODEPOSTAL'])) {echo 'value="'.$LeSponso['CODEPOSTAL'].'"';}?>>
    <label for="txtVille"><span class='textBlanc'>Ville : </span></label>
    <input type="text" name='txtVille' class='form-control'  <?php if (isset($LeSponso['VILLE'])) {echo 'value="'.$LeSponso['VILLE'].'"';}?>>
    <label for="txtTelPortable"><span class='textBlanc'>Numéro de téléphone Portable : </span></label>
    <input type="text" name='txtTelPortable' class='form-control'  <?php if (isset($LeSponso['TELPORTABLE'])) {echo 'value="'.$LeSponso['TELPORTABLE'].'"';}?>>
    <label for="txtTelFixe"><span class='textBlanc'>Numéro de téléphone fixe: </span></label>
    <input type="text" name='txtTelFixe' class='form-control'  <?php if (isset($LeSponso['TELFIXE'])) {echo 'value="'.$LeSponso['TELFIXE'].'"';}?>>
    <label for="txtMail"><span class='textBlanc'>Email : </span></label>
    <input type="text" name='txtMail' class='form-control' pattern='^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,4}$' <?php if (isset($LeSponso['EMAIL'])) {echo 'value="'.$LeSponso['EMAIL'].'"';}?>>
    <br>
    <label for="nocontributeur"><span class='textBlanc'>Séléctionner un contributeur : </span></label>
    <select id="combobox2" name='nocontributeur'>
    <option value="">Selectionne un...</option>
    <?php 
    foreach ($LesContributeurs as $UnContributeur) {
        echo '<option value="'.$UnContributeur['NOCONTRIBUTEUR'].'" ';
        if ($LeContributeur['NOCONTRIBUTEUR']==$UnContributeur['NOCONTRIBUTEUR']) {
          echo 'selected';
        }
        echo '>'.$UnContributeur['NOM'].' '.$UnContributeur['PRENOM'].'</option>';
    }
    ?>
  </select>
  <br><br>
    <?php
    
    if (isset($LeSponso['NOM'])) {echo "<input type='submit' name='submitModif' value='Envoi' class='btn btn-primary'>";}
else {echo "<input type='submit' name='submitForm' value='Envoi' class='btn btn-primary'>";}?>
</p>
</form>
</div></div></section>