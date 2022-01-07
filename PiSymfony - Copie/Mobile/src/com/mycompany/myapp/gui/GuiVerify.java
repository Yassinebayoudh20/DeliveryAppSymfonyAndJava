/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.gui;

import com.codename1.ui.Button;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.Form;
import com.codename1.ui.TextField;
import com.codename1.ui.layouts.BoxLayout;

/**
 *
 * @author ASUS
 */
public class GuiVerify extends Form{
     public GuiVerify(int codeV , String username , Form f){
    Container form = new Container(BoxLayout.y());
    TextField code = new TextField("Code");
    Button verifier = new Button("Check");
    verifier.addActionListener((evt) -> {
        if (Integer.valueOf(code.getText())==codeV){
            
            new GuiForgetPassword(username , f).show();
                 
        }
    });
    
    form.addAll(code,verifier);
    add(form);
    
    } 
}
