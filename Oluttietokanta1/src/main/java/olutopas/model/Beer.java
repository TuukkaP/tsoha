package olutopas.model;

import java.util.ArrayList;
import java.util.List;
import javax.persistence.CascadeType;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.ManyToMany;
import javax.persistence.ManyToOne;
import javax.persistence.OneToMany;

@Entity
public class Beer {

    private String name;
    @Id
    private Integer id;
    @ManyToOne
    private Brewery brewery;
    @OneToMany(cascade = CascadeType.ALL)
    private ArrayList<Rating> ratings;
    @ManyToMany(mappedBy = "beers", cascade = CascadeType.ALL)
    List<Pub> pubs;

    public Beer() {
    }

    public Beer(String name) {
        ratings = new ArrayList<Rating>();
        this.name = name;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    public Integer getId() {
        return id;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getName() {
        return name;
    }

    public Brewery getBrewery() {
        return brewery;
    }

    public void setBrewery(Brewery brewery) {
        this.brewery = brewery;
    }

    public double getRatingsAverage() {
        if (getRatings() == null) {
            return 0.0;
        }
        double sum = 0.0;
        int count = 0;
        for (Rating rating : getRatings()) {
            sum += rating.getValue();
            count++;
        }

        return sum / count;
    }

    public ArrayList<Rating> getRatings() {
        return ratings;
    }

    public int getRatingsAmount() {
        if (getRatings() != null) {
            return getRatings().size();
        }
        return 0;
    }

    public void setRatings(ArrayList<Rating> ratings) {
        this.ratings = ratings;
    }

    @Override
    public String toString() {
        // olioiden kannattaa sisäisestikin käyttää gettereitä oliomuuttujien sijaan
        // näin esim. olueeseen liittyvä panimo tulee varmasti ladattua kannasta
        return getName() + " (" + getBrewery().getName() + ")\n\t number of ratings: " + getRatingsAmount() + " average " + getRatingsAverage();
    }

    public void setPubs(List<Pub> pubs) {
        this.pubs = pubs;
    }

    public List<Pub> getPubs() {
        return pubs;
    }

    public void addToPubs(Pub pub) {
        if (pubs == null) {
            pubs = new ArrayList<Pub>();
        }
        pubs.add(pub);
    }

    public void removePub(Pub pub) {
        pubs.remove(pub);
    }

    @Override
    public int hashCode() {
        int hash = 3;
        hash = 61 * hash + (this.id != null ? this.id.hashCode() : 0);
        return hash;
    }
}
