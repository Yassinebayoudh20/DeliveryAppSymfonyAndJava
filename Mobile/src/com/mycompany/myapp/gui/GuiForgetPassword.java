/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.gui;
import com.codename1.ui.Button;
import static com.codename1.ui.Component.CENTER;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.Form;
import com.codename1.ui.TextField;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.layouts.FlowLayout;
import com.mycompany.myapp.entities.Utilisateur;
import com.mycompany.myapp.services.UserService;

/**
 *
 * @author ASUS
 */
public class GuiForgetPassword extends Form{
     public GuiForgetPassword(String username,Form f){
         setTitle("New Password");        
         setLayout(new FlowLayout(CENTER));
        Container formPassword = new Container(BoxLayout.y());
            TextField mdp = new TextField("", "Password", 20, TextField.PASSWORD);
            TextField mdp2 = new TextField("","Confirm Password", 20, TextField.PASSWORD);
              Button confirmer = new Button("confirm ");
            
            confirmer.addActionListener((evtt) -> {
                if(mdp.getText().compareTo(mdp2.getText())==0){
                    // n3aytouu ll action bch nbdlou mdp
                    UserService.getInstance().ModifierPwd(username, mdp.getText());
                    new GuiLogin(f).show();
                    
                }else
                {
                  Dialog.show("Error", "Password not identical", "OK", null);  
                }
                
            });
            formPassword.addAll(mdp,mdp2,confirmer);
            
            
            add(formPassword);
                 
        }
}
