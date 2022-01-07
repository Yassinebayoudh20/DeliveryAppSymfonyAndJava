/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.gui;

import com.codename1.ui.Button;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.Label;
import com.codename1.ui.TextField;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.layouts.BoxLayout;
import com.mycompany.myapp.entities.Utilisateur;
import com.mycompany.myapp.services.UserService;

/**
 *
 * @author ASUS
 */
public class GuiProfil extends Form {

    public GuiProfil(Form f) {
        setTitle("My Profile");
        setLayout(BoxLayout.y());
        System.out.println("xxxxxxxxxxx: "+Utilisateur.currentuser);
        Label username = new Label("Username : "+Utilisateur.currentuser.getUsername());
        Label email = new Label("Email : "+Utilisateur.currentuser.getEmail());
        Label name = new Label("Name : "+Utilisateur.currentuser.getNom());
        Label lastname = new Label("Last Name : "+Utilisateur.currentuser.getPrenom());
        Label number = new Label("Number : " + Utilisateur.currentuser.getNum_tel());
        Label cin = new Label("Cin : " + Utilisateur.currentuser.getCin());
        
        getToolbar().addMaterialCommandToLeftBar("Back", FontImage.MATERIAL_ARROW_BACK, (e)->new GUIHomePage(f).showBack());
        getToolbar().addMaterialCommandToRightBar("Log Out", FontImage.MATERIAL_ALL_OUT, (e)->new GuiLogin(f).showBack());

        Button editprofil = new Button("Edit profil");

        editprofil.addActionListener((e) -> {

            Form form = new Form(BoxLayout.y());
            Label usernameTxt = new Label("Username : ");
            usernameTxt.getStyle().setFgColor(0x000000);

            Label emailTxt = new Label("Email : ");
            emailTxt.getStyle().setFgColor(0x000000);

            Label NameTxt = new Label("Name : ");
            NameTxt.getStyle().setFgColor(0x000000);

            Label LastnameTxt = new Label("Lastname: ");
            LastnameTxt.getStyle().setFgColor(0x000000);

            Label TelNumberTxt = new Label("Phone Number: ");
            TelNumberTxt.getStyle().setFgColor(0x000000);

            Label CinTxt = new Label("Cin Number: ");
            CinTxt.getStyle().setFgColor(0x000000);

            TextField usernametxtf = new TextField(Utilisateur.currentuser.getUsername());
            TextField emailtxtf = new TextField(Utilisateur.currentuser.getEmail());
            TextField nametxtf = new TextField(Utilisateur.currentuser.getNom());
            TextField lastnametxtf = new TextField(Utilisateur.currentuser.getPrenom());
            TextField telnumbertxtf = new TextField(""+Utilisateur.currentuser.getNum_tel());
            TextField cinnumbertxtf = new TextField(""+Utilisateur.currentuser.getCin());

            Button editnow = new Button("Save");
            editnow.addActionListener((ActionEvent evt) -> {

                Utilisateur user = new Utilisateur();
                user.setUsername(usernametxtf.getText());
                user.setEmail(emailtxtf.getText());
                user.setNom(nametxtf.getText());
                user.setPrenom(lastnametxtf.getText());
                user.setNum_tel(Integer.parseInt(telnumbertxtf.getText()));
                user.setCin(Integer.parseInt(cinnumbertxtf.getText()));

                Utilisateur.currentuser = UserService.getInstance().EditUser(user);
                
                new GuiProfil(form).show();
            });

            form.addAll(usernameTxt, usernametxtf, emailTxt, emailtxtf, NameTxt, nametxtf, LastnameTxt, lastnametxtf,
                    TelNumberTxt, telnumbertxtf, CinTxt, cinnumbertxtf, editnow);
            form.show();
        });
        addAll(username, email, name, lastname, number, cin, editprofil);

    }

}
