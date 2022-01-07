/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.gui;

import com.codename1.ui.Button;
import com.codename1.ui.Command;
import com.codename1.ui.Dialog;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.Label;
import com.codename1.ui.TextArea;
import com.codename1.ui.TextField;
import com.codename1.ui.layouts.FlowLayout;
import com.mycompany.myapp.entities.Utilisateur;
import com.mycompany.myapp.services.UserService;

/**
 *
 * @author ASUS
 */
public class GuiRegister extends Form {

    public GuiRegister(Form f) {
        setTitle("Register User");
        setLayout(new FlowLayout());
        Label usernameTxt = new Label("Username : ");
        usernameTxt.getStyle().setFgColor(0x000000);

        Label emailTxt = new Label("Email : ");
        emailTxt.getStyle().setFgColor(0x000000);

        Label passwordTxt = new Label("Password : ");
        passwordTxt.getStyle().setFgColor(0x000000);

        Label confpassTxt = new Label("Confirme Password : ");
        confpassTxt.getStyle().setFgColor(0x000000);

        Label namesTxt = new Label("Name : ");
        namesTxt.getStyle().setFgColor(0x000000);

        Label lastnameTxt = new Label("Last Name : ");
        lastnameTxt.getStyle().setFgColor(0x000000);

        Label numberTxt = new Label("Number : ");
        numberTxt.getStyle().setFgColor(0x000000);

        Label cinTxt = new Label("CIN : ");
        cinTxt.getStyle().setFgColor(0x000000);

        TextField firstNametxtF = new TextField("", "Username", 20, TextArea.ANY);
        TextField emailtxtF = new TextField("", "Email", 20, TextArea.EMAILADDR);
        TextField passwordtxtF = new TextField("", "Password", 20, TextField.PASSWORD);
        TextField confirmepasswordtxtF = new TextField("", "Confirme Password", 20, TextField.PASSWORD);
        TextField namesTxtF = new TextField("", "Name", 20, TextArea.ANY);
        TextField lastamnetxtF = new TextField("", "Last Name", 20, TextArea.ANY);
        TextField numbertxtF = new TextField("", "Phone", 20, TextArea.PHONENUMBER);
        TextField cintxtF = new TextField("", "CIN", 20, TextArea.NUMERIC);
        getToolbar().addMaterialCommandToLeftBar("Back", FontImage.MATERIAL_ARROW_BACK, (e)->new GuiLogin(f).showBack());
        Button submit = new Button("Add User");

        submit.addActionListener((evt) -> {
            if ((numbertxtF.getText().length()!=8||
                    (cintxtF.getText().length()!=8)))
               
                    Dialog.show("Alert", "You must fill 8 numbers", new Command("Try Again"));          
                    else{
            
            if ((firstNametxtF.getText().length()==0||
                    (emailtxtF.getText().length()==0)||
                    (passwordtxtF.getText().length()==0)||
                    (namesTxtF.getText().length()==0)||
                    (lastamnetxtF.getText().length()==0)||
                    (numbertxtF.getText().length()==0)||
                    (cintxtF.getText().length()==0)))
                    Dialog.show("Alert", "Please fill all the fields", new Command("OK"));          
                    else{
            Utilisateur user = new Utilisateur();
            user.setUsername(firstNametxtF.getText());
            user.setEmail(emailtxtF.getText());
            user.setPassword(passwordtxtF.getText());
            user.setNom(namesTxtF.getText());
            user.setPrenom(lastamnetxtF.getText());
            user.setNum_tel(Integer.parseInt(numbertxtF.getText()));
            user.setCin(Integer.parseInt(cintxtF.getText()));

            if (UserService.getInstance().AddUser(user)) {
                Dialog.show("success", "Welcome In Our App", "OK", null);
            } else {
                Dialog.show("Failed", "You Can't Add This User", "eurreur", null);
            }

        }}});

        addAll(usernameTxt, firstNametxtF, emailTxt, emailtxtF, passwordTxt, passwordtxtF,
                confpassTxt, confirmepasswordtxtF, namesTxt, namesTxtF, lastnameTxt, lastamnetxtF,
                numberTxt, numbertxtF, cinTxt, cintxtF, submit);
    }
}
