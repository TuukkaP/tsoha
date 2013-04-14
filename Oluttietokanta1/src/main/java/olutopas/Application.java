package olutopas;

import com.avaje.ebean.EbeanServer;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;
import javax.persistence.OptimisticLockException;
import olutopas.model.Beer;
import olutopas.model.Brewery;
import olutopas.model.Pub;
import olutopas.model.Rating;
import olutopas.model.User;

public class Application {

    private EbeanServer server;
    private Scanner scanner = new Scanner(System.in);
    private User user;

    public Application(EbeanServer server) {
        this.server = server;
    }

    public void run(boolean newDatabase) {
        if (newDatabase) {
            seedDatabase();
        }
        System.out.println("Login (give ? to register a new user) or press enter");
        String command = scanner.nextLine();
        if (command.equals("?")) {
            System.out.println("Register a new user");
            createUser();
        }
        System.out.println("Login");
        loginUser();

        while (true) {
            menu();
            System.out.print("> ");
            command = scanner.nextLine();

            if (command.equals("0")) {
                break;
            } else if (command.equals("1")) {
                findBrewery();
            } else if (command.equals("2")) {
                findBeer();
            } else if (command.equals("3")) {
                addBeer();
            } else if (command.equals("4")) {
                listBreweries();
            } else if (command.equals("5")) {
                deleteBeer();
            } else if (command.equals("6")) {
                listBeers();
            } else if (command.equals("7")) {
                addBrewery();
            } else if (command.equals("8")) {
                deleteBrewery();
            } else if (command.equals("t")) {
                showRating();
            } else if (command.equals("y")) {
                listUsers();
            } else if (command.equals("p")) {
                showBeersFromPub();
            } else if (command.equals("l")) {
                listPubs();
            } else if (command.equals("r")) {
                deleteBeerFromPub();
            } else if (command.equals("a")) {
                addBeerToPub();
            } else {
                System.out.println("unknown command");
            }

            System.out.print("\npress enter to continue");
            scanner.nextLine();
        }

        System.out.println("bye");
    }

    private void menu() {
        System.out.println("");
        System.out.println("1   find brewery");
        System.out.println("2   find beer");
        System.out.println("3   add beer");
        System.out.println("4   list breweries");
        System.out.println("5   delete beer");
        System.out.println("6   list beers");
        System.out.println("7   add brewery");
        System.out.println("8   delete brewery");
        System.out.println("t   show my ratings");
        System.out.println("y   list users");
        System.out.println("p   show beers in pub");
        System.out.println("l   list pub");
        System.out.println("r   remove beer from pub");
        System.out.println("a   add beer to pub");
        System.out.println("0   quit");
        System.out.println("");
    }

    private void listBeers() {
        List<Beer> beers = server.find(Beer.class).findList();
        if (beers.size() != 0) {
            for (Beer beer : beers) {
                System.out.println(beer.getName() + "(" + beer.getBrewery() + ")");
                List<Rating> ratings = server.find(Rating.class).where().eq("beer_id", beer.getId()).findList();
                if (ratings != null) {
                    double sum = 0;
                    for (Rating rating : ratings) {
                        sum += rating.getValue();
                    }
                    System.out.println("ratings given " + ratings.size() + " average " + sum / ratings.size());
                } else {
                    System.out.println("No ratings given");
                }
            }
        } else {
            System.out.println("Tietokannassa ei ole oluita.");
        }

    }

    private void addBrewery() {
        System.out.print("brewerys name: ");
        String name = scanner.nextLine();
        Brewery brewery = new Brewery(name);

        Brewery exists = server.find(Brewery.class).where().like("name", name).findUnique();
        if (exists != null) {
            System.out.println(name + " exists already");
            return;
        }

        server.save(brewery);
    }

    private void deleteBrewery() {
        System.out.print("brewerys name: ");
        String name = scanner.nextLine();
        Brewery brewery = new Brewery(name);

        Brewery exists = server.find(Brewery.class).where().like("name", name).findUnique();
        if (exists != null) {
            server.delete(brewery);
            return;
        }

        System.out.println("Delete fail");
    }

    private void createUser() {
        System.out.print("give username: ");
        String name = scanner.nextLine();
        User user = new User(name);

        User exists = server.find(User.class).where().like("name", name).findUnique();
        if (exists == null) {
            server.save(user);
            return;
        }

        System.out.println("User creation failed");
    }

    private void loginUser() {
        System.out.print("give username: ");
        String name = scanner.nextLine();
        User user = new User(name);

        User exists = server.find(User.class).where().like("name", name).findUnique();
        if (exists == null) {
            System.exit(0);
        }
        this.user = user;
        System.out.println("Welcome to Ratebeer " + user.getName());
    }

    private void showRating() {
        try {
            List<Rating> ratings = server.find(Rating.class).where().eq("user_id", user.getId()).findList();
            for (Rating rating : ratings) {
                System.out.println(rating);
            }
        } catch (Exception e) {

            System.out.println("Arvosteluita ei ole.");
        }
    }

    private void listUsers() {
        for (User user : server.find(User.class).findList()) {
            System.out.println(user.getName());
        }
    }

    private void seedDatabase() throws OptimisticLockException {
        Brewery brewery = new Brewery("Schlenkerla");
        brewery.addBeer(new Beer("Urbock"));
        brewery.addBeer(new Beer("Lager"));
        // tallettaa myös luodut oluet, sillä Brewery:n OneToMany-mappingiin on määritelty
        // CascadeType.all
        server.save(brewery);

        // luodaan olut ilman panimon asettamista
        Beer b = new Beer("Märzen");
        server.save(b);

        // jotta saamme panimon asetettua, tulee olot lukea uudelleen kannasta
        b = server.find(Beer.class, b.getId());
        brewery = server.find(Brewery.class, brewery.getId());
        brewery.addBeer(b);
        server.save(brewery);

        server.save(new Brewery("Paulaner"));

        server.save(new Pub("Pikkulintu"));

        server.save(new User("mluukkai"));
    }

    private void findBeer() {
        System.out.print("beer to find: ");
        String n = scanner.nextLine();
        Beer foundBeer = server.find(Beer.class).where().like("name", n).findUnique();

        if (foundBeer == null) {
            System.out.println(n + " not found");
            return;
        }

        System.out.println(foundBeer.toString());
//        System.out.println(foundBeer.getName() + "(" + foundBeer.getBrewery()+ ")\n\tnumber of ratings: " + foundBeer.getRatingsAmount() + " average " +foundBeer.getRatingsAverage());


        if (foundBeer.getPubs() == null || foundBeer.getPubs().isEmpty()) {
            System.out.println("  not available currently!");

        } else {
            System.out.println("  available now in:");
            for (Pub pub : foundBeer.getPubs()) {
                System.out.println("   " + pub);
            }
        }
        System.out.print("give rating (leave emtpy if not): ");
        try {
            int value = Integer.parseInt(scanner.nextLine());
            User exists = server.find(User.class).where().like("name", user.getName()).findUnique();
            Rating rating = new Rating(foundBeer, exists, value);
            server.save(rating);
        } catch (Exception e) {
        }

    }

    private void findBrewery() {
        System.out.print("brewery to find: ");
        String n = scanner.nextLine();
        Brewery foundBrewery = server.find(Brewery.class).where().like("name", n).findUnique();

        if (foundBrewery == null) {
            System.out.println(n + " not found");
            return;
        }

        System.out.println(foundBrewery);
        for (Beer bier : foundBrewery.getBeers()) {
            System.out.println("   " + bier.getName());
        }
    }

    private void listBreweries() {
        List<Brewery> breweries = server.find(Brewery.class).findList();
        for (Brewery brewery : breweries) {
            System.out.println(brewery);
        }
    }

    private void addPub() {
        System.out.print("pub to add: ");

        String name = scanner.nextLine();

        Pub exists = server.find(Pub.class).where().like("name", name).findUnique();
        if (exists != null) {
            System.out.println(name + " exists already");
            return;
        }

        server.save(new Pub(name));
    }

    private void addBeer() {
        System.out.print("to which brewery: ");
        String name = scanner.nextLine();
        Brewery brewery = server.find(Brewery.class).where().like("name", name).findUnique();

        if (brewery == null) {
            System.out.println(name + " does not exist");
            return;
        }

        System.out.print("beer to add: ");

        name = scanner.nextLine();

        Beer exists = server.find(Beer.class).where().like("name", name).findUnique();
        if (exists != null) {
            System.out.println(name + " exists already");
            return;
        }

        brewery.addBeer(new Beer(name));
        server.save(brewery);
        System.out.println(name + " added to " + brewery.getName());
    }

    private void deleteBeer() {
        System.out.print("beer to delete: ");
        String n = scanner.nextLine();
        Beer beerToDelete = server.find(Beer.class).where().like("name", n).findUnique();

        if (beerToDelete == null) {
            System.out.println(n + " not found");
            return;
        }

        server.delete(beerToDelete);
        System.out.println("deleted: " + beerToDelete);

    }

    private void addBeerToPub() {
        System.out.print("beer: ");
        String name = scanner.nextLine();
        Beer beer = server.find(Beer.class).where().like("name", name).findUnique();

        if (beer == null) {
            System.out.println("does not exist");
            return;
        }

        System.out.print("pub: ");
        name = scanner.nextLine();
        Pub pub = server.find(Pub.class).where().like("name", name).findUnique();

        if (pub == null) {
            System.out.println("does not exist");
            return;
        }

        pub.addBeer(beer);
        server.save(pub);
    }

    private void deleteBeerFromPub() {
        System.out.print("pub to delete beer from: ");
        String pub = scanner.nextLine();
        Pub pubToFind = server.find(Pub.class).where().like("name", pub).findUnique();

        if (pubToFind == null) {
            System.out.println(pub + " not found");
            return;
        }
        System.out.print("beer to delete: ");
        String beer = scanner.nextLine();
        
        Beer beerDel = null;
        for (Beer olut : pubToFind.getBeers()) {
            if (olut.getName().equals(beer)) {
                beerDel = olut;
            }
        }
        
        pubToFind.removeBeer(beerDel);
        server.save(pubToFind);
        System.out.println("deleted: " + beer + " from pub: " + pubToFind.getName());

    }

    private void showBeersFromPub() {
        System.out.print("select pub: ");
        String pub = scanner.nextLine();
        Pub pubToFind = server.find(Pub.class).where().like("name", pub).findUnique();

        if (pubToFind == null) {
            System.out.println(pub + " not found");
            return;
        }

        for (Beer beer : pubToFind.getBeers()) {
            System.out.println(beer.getName() + "(" + beer.getBrewery() + ")");
            List<Rating> ratings = server.find(Rating.class).where().eq("beer_id", beer.getId()).findList();
            if (ratings != null) {
                double sum = 0;
                for (Rating rating : ratings) {
                    sum += rating.getValue();
                }
                System.out.println("ratings given " + ratings.size() + " average " + sum / ratings.size());
            } else {
                System.out.println("No ratings given");
            }
        }
    }

    private void listPubs() {
        for (Pub pub : server.find(Pub.class).findList()) {
            System.out.println(pub);
        }
    }
}
